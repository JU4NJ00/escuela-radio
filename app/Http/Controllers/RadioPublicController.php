<?php

namespace App\Http\Controllers;

use App\Models\Posteo;
use App\Models\Programa;
use App\Models\Programacion;
use Carbon\Carbon;

class RadioPublicController extends Controller
{
    public function index()
    {
        $now = Carbon::now('America/Argentina/Buenos_Aires');

        // Carbon::dayOfWeek devuelve 0 para domingo, 1 para lunes, etc.
        // Tu base de datos usa 0 para lunes, 1 para martes, etc.
        // Hacemos el ajuste para que coincida.
        // (0 = Dom, 1 = Lun, 2 = Mar... ) --> (0 = Lun, 1 = Mar... )
        $carbonDayOfWeek = $now->dayOfWeek;

        // Si es domingo (Carbon::SUNDAY o 0), el día en tu DB debería ser 6 (Domingo).
        // Si no, simplemente restamos 1 para que Lunes (1) sea 0, Martes (2) sea 1, etc.
        $dbDayOfWeek = ($carbonDayOfWeek === Carbon::SUNDAY) ? 6 : $carbonDayOfWeek - 1;

        // Programación de hoy
        $programacionesHoy = Programacion::where('dia_semana', $dbDayOfWeek)
            ->with('programa')
            ->orderBy('hora_inicio')
            ->get();

        // Programación de mañana
        $tomorrow = $now->copy()->addDay();
        $carbonTomorrowDayOfWeek = $tomorrow->dayOfWeek;
        $dbTomorrowDayOfWeek = ($carbonTomorrowDayOfWeek === Carbon::SUNDAY) ? 6 : $carbonTomorrowDayOfWeek - 1;

        $programacionesManana = Programacion::where('dia_semana', $dbTomorrowDayOfWeek)
            ->with('programa')
            ->orderBy('hora_inicio')
            ->get();

        // Programa actual
        $actual = Programacion::where('dia_semana', $dbDayOfWeek)
            ->where('hora_inicio', '<=', $now->format('H:i:s'))
            ->where('hora_fin', '>=', $now->format('H:i:s'))
            ->with('programa')
            ->first();

        // Obtener posteos
        $posteos = Posteo::orderBy('created_at', 'desc')->get();

        return view('welcome', compact(
            'now',
            'programacionesHoy',
            'programacionesManana',
            'actual',
            'posteos'
        ));
    }
}
