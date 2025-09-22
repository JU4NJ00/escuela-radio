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

        $ultimosPosteos = Posteo::orderBy('created_at', 'desc')->limit(5)->get();
        $ultimosProgramas = Programa::orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('counts', 'ultimosPosteos', 'ultimosProgramas'));
    }
}
