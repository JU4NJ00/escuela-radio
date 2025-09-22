<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posteo;

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard con los posteos existentes.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtener todos los posteos, ordenados por fecha de creación de forma descendente y paginados
        $posteos = Posteo::latest()->paginate(8);

        // Retornar la vista del dashboard con los posteos paginados
        return view('dashboard', compact('posteos'));
    }
}
