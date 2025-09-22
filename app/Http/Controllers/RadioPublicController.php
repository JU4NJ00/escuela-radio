<?php

namespace App\Http\Controllers;

use App\Models\Programacion;
use App\Models\Programa;
use Carbon\Carbon;

class RadioPublicController extends Controller
{
    public function index()
    {
        // Zona horaria Argentina
        $now = Carbon::now('America/Argentina/Buenos_Aires');
        $todayIndex = $now->isoWeekday() - 1; // 0 = lunes ... 6 = domingo (según migración)
        $tomorrowIndex = ($todayIndex + 1) % 7;

        $programacionesHoy = Programacion::with('programa')
            ->where('dia_semana', $todayIndex)
            ->orderBy('hora_inicio')
            ->get();

        $programacionesManana = Programacion::with('programa')
            ->where('dia_semana', $tomorrowIndex)
            ->orderBy('hora_inicio')
            ->get();

        // Determinar programa actual (tolerante a formatos H:i o H:i:s)
        $actual = null;
        foreach ($programacionesHoy as $p) {
            try {
                $hiStr = trim($p->hora_inicio ?? '');
                $hfStr = trim($p->hora_fin ?? '');

                if ($hiStr === '' || $hfStr === '') {
                    continue; // datos incompletos
                }

                // Intentar varios formatos
                $formats = ['H:i:s', 'H:i'];
                $hi = null;
                $hf = null;
                foreach ($formats as $f) {
                    try {
                        $hi = Carbon::createFromFormat($f, $hiStr, 'America/Argentina/Buenos_Aires');
                        break;
                    } catch (\Exception $e) {
                        $hi = null;
                    }
                }
                foreach ($formats as $f) {
                    try {
                        $hf = Carbon::createFromFormat($f, $hfStr, 'America/Argentina/Buenos_Aires');
                        break;
                    } catch (\Exception $e) {
                        $hf = null;
                    }
                }

                if (!$hi || !$hf) {
                    continue; // formato inválido, saltar
                }

                // Asegurar que los Carbon tienen la misma fecha que $now para comparar correctamente
                $hi = $hi->setDate($now->year, $now->month, $now->day);
                $hf = $hf->setDate($now->year, $now->month, $now->day);

                if ($now->between($hi, $hf)) {
                    $actual = $p;
                    break;
                }
            } catch (\Exception $e) {
                // ignorar programacion con formato inválido
                continue;
            }
        }

        return view('welcome', compact('programacionesHoy', 'programacionesManana', 'actual', 'now'));
    }
}
