<?php

namespace App\Http\Controllers;

use App\Models\Posteo;
use App\Models\Programa;
use App\Models\Programacion;

class DashboardController extends Controller
{
    /**
     * Mostrar panel admin con resumen y accesos rápidos.
     */
    public function index()
    {
        $counts = [
            'posteos' => Posteo::count(),
            'programas' => Programa::count(),
            'programaciones' => Programacion::count(),
        ];

        // Últimos 5
        $ultimosPosteos = Posteo::orderBy('created_at', 'desc')->limit(5)->get();
        $ultimosProgramas = Programa::orderBy('created_at', 'desc')->limit(5)->get();

        // 🔹 Todos los posteos (ordenados del más nuevo al más viejo)
        $posteos = Posteo::orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact(
            'counts',
            'ultimosPosteos',
            'ultimosProgramas',
            'posteos' // se pasa a la vista
        ));
    }
}
