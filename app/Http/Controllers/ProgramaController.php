<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProgramaController extends Controller
{
    /**
     * Mostrar todos los programas.
     */
    public function index()
    {
        $programas = Programa::all();
        return view('radio.programas.index', compact('programas'));
    }

    /**
     * Formulario para crear un nuevo programa.
     */
    public function create()
    {
        return view('radio.programas.create');
    }

    /**
     * Guardar un nuevo programa en la BD.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'conductor' => 'nullable|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            // campos de programación
            'dia_semana' => 'nullable|integer|min:0|max:6',
            'hora_inicio' => 'nullable|date_format:H:i',
            'hora_fin' => 'nullable|date_format:H:i|after:hora_inicio',
        ]);

        try {
            DB::beginTransaction();

            // Procesar imagen si se subió
            if ($request->hasFile('imagen')) {
                $path = $request->file('imagen')->store('programas', 'public');
                $validated['imagen'] = $path;
            }

            // Crear programa
            $programa = Programa::create([
                'nombre' => $validated['nombre'],
                'descripcion' => $validated['descripcion'] ?? null,
                'conductor' => $validated['conductor'] ?? null,
                'imagen' => $validated['imagen'] ?? null,
            ]);

            // Crear programación inicial (si se completaron campos)
            if ($request->filled(['dia_semana', 'hora_inicio', 'hora_fin'])) {
                $programa->programaciones()->create([
                    'dia_semana' => $validated['dia_semana'],
                    'hora_inicio' => $validated['hora_inicio'],
                    'hora_fin'   => $validated['hora_fin'],
                ]);
            }

            DB::commit();

            return redirect()
                ->route('radio.programas.index')
                ->with('success', 'Programa y programación inicial creados correctamente ✅');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Ocurrió un error al guardar: ' . $e->getMessage()]);
        }
    }




    /**
     * Mostrar un programa específico.
     */
    public function show(\App\Models\Programa $programa)
    {
        // Cargar todas las programaciones asociadas a este programa
        $programa->load('programaciones');


        return view('radio.programas.show', compact('programa'));
    }


    /**
     * Formulario para editar un programa.
     */
    public function edit(Programa $programa)
    {
        return view('radio.programas.edit', compact('programa'));
    }

    /**
     * Actualizar un programa en la BD.
     */

    public function update(Request $request, Programa $programa)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'conductor' => 'nullable|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'programaciones' => 'nullable|array',
            'programaciones.*.id' => 'nullable|integer|exists:programaciones,id',
            'programaciones.*.dia_semana' => 'nullable|integer|min:0|max:6',
            'programaciones.*.hora_inicio' => 'nullable|date_format:H:i',
            'programaciones.*.hora_fin'   => 'nullable|date_format:H:i|after:programaciones.*.hora_inicio',

        ], [
            'programaciones.*.hora_inicio.regex' => 'La hora de inicio debe tener formato HH:MM (00–23:59).',
            'programaciones.*.hora_fin.regex'    => 'La hora de fin debe tener formato HH:MM (00–23:59).',
        ]);

        $programaciones = collect($validated['programaciones'] ?? [])
            ->filter(fn($p) => !empty($p['dia_semana']) && !empty($p['hora_inicio']) && !empty($p['hora_fin']))
            ->map(function ($p) {
                return [
                    'id' => $p['id'] ?? null,
                    'dia_semana' => (int) $p['dia_semana'],
                    'hora_inicio' => substr($p['hora_inicio'], 0, 5), // normaliza a HH:MM
                    'hora_fin'    => substr($p['hora_fin'], 0, 5),    // normaliza a HH:MM
                ];
            });


        $validated = $validator->validate();

        try {
            DB::beginTransaction();

            // Imagen: si hay nueva, borramos la vieja y guardamos la nueva
            if ($request->hasFile('imagen')) {
                if ($programa->imagen) {
                    Storage::disk('public')->delete($programa->imagen);
                }
                $validated['imagen'] = $request->file('imagen')->store('programas', 'public');
            }

            // Actualizar programa
            $programa->update([
                'nombre' => $validated['nombre'],
                'descripcion' => $validated['descripcion'] ?? null,
                'conductor' => $validated['conductor'] ?? null,
                'imagen' => $validated['imagen'] ?? $programa->imagen,
            ]);

            // Filtrar filas vacías y normalizar HH:MM
            $programaciones = collect($validated['programaciones'] ?? [])
                ->filter(
                    fn($p) =>
                    !empty($p['dia_semana']) &&
                        !empty($p['hora_inicio']) &&
                        !empty($p['hora_fin'])
                );

            $idsEnviados = [];

            foreach ($programaciones as $p) {
                $hi = substr($p['hora_inicio'], 0, 5);
                $hf = substr($p['hora_fin'], 0, 5);

                if (!empty($p['id'])) {
                    // actualizar existente
                    $programacion = $programa->programaciones()->find($p['id']);
                    if ($programacion) {
                        $programacion->update([
                            'dia_semana' => (int)$p['dia_semana'],
                            'hora_inicio' => $hi,
                            'hora_fin'   => $hf,
                        ]);
                        $idsEnviados[] = $programacion->id;
                    }
                } else {
                    // crear nueva
                    $nueva = $programa->programaciones()->create([
                        'dia_semana' => (int)$p['dia_semana'],
                        'hora_inicio' => $hi,
                        'hora_fin'   => $hf,
                    ]);
                    $idsEnviados[] = $nueva->id;
                }
            }

            // Eliminar las programaciones que ya no vinieron del form
            $programa->programaciones()
                ->whereNotIn('id', $idsEnviados)
                ->delete();

            DB::commit();

            return redirect()
                ->route('radio.programas.show', $programa)
                ->with('success', 'Programa y programaciones actualizados correctamente ✅');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['error' => 'Ocurrió un error: ' . $e->getMessage()]);
        }
    }



    /**
     * Eliminar un programa de la BD.
     */
    public function destroy(Programa $programa)
    {
        $programa->delete();

        return redirect()->route('radio.programas.index')
            ->with('success', 'Programa eliminado correctamente 🗑️');
    }
}
