<?php

namespace App\Http\Controllers;

use App\Models\Posteo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PosteoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Asegura que solo usuarios logueados puedan acceder
    }

    /**
     * Mostrar lista de posteos.
     */
    public function index()
    {
        $posteos = Posteo::with('usuario')->latest()->paginate(8);
        return view('posteos.index', compact('posteos'));
    }

    /**
     * Mostrar formulario para crear posteo.
     */
    public function create()
    {
        return view('posteos.create');
    }

    /**
     * Guardar un nuevo posteo.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required',
            'extracto' => 'nullable|string|max:500',
            'imagen_destacada' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8048',
            'estado' => 'required|in:borrador,publicado,archivado',
            'categoria_id' => 'nullable|string|max:255', // Validamos el campo de texto
            'etiquetas' => 'nullable|string|max:255', // Validamos el campo de texto
            'fecha_publicacion' => 'nullable|date',
        ]);

        // Procesar la imagen si se subió
        $imagenPath = null;
        if ($request->hasFile('imagen_destacada')) {
            $imagenPath = $request->file('imagen_destacada')->store('posteos', 'public');
        }

        // Procesar etiquetas a un array
        $etiquetasArray = $request->input('etiquetas') ? explode(',', $request->input('etiquetas')) : null;

        // 🌟 Sanitizar el campo 'contenido' antes de guardarlo 🌟
        $sanitizedContent = clean($request->contenido); // 'clean' es la función que proporciona la librería

        $posteo = Posteo::create([
            'usuario_id' => Auth::id(),
            'titulo' => $request->titulo,
            'slug' => Str::slug($request->titulo) . '-' . uniqid(),
            'contenido' => $sanitizedContent,
            'extracto' => $request->extracto,
            'imagen_destacada' => $imagenPath,
            'estado' => $request->estado,
            'categoria' => $request->categoria_id,
            'etiquetas' => $etiquetasArray,
            'fecha_publicacion' => $request->fecha_publicacion,
        ]);

        return redirect()->route('posteo.index')
            ->with('success', 'Posteo creado correctamente.');
    }

    /**
     * Maneja la subida de imágenes desde el editor CKEditor.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImageFromEditor(Request $request)
    {
        // Validar el archivo de imagen subido
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8048',
        ]);

        // Guardar la imagen en el disco público dentro de un directorio 'ckeditor/images'
        if ($request->hasFile('upload')) {
            $path = $request->file('upload')->store('ckeditor/images', 'public');

            // Devolver la URL de la imagen en el formato que CKEditor espera
            return response()->json(['url' => Storage::url($path)]);
        }

        // Si no hay archivo, devolver un error
        return response()->json(['error' => 'No se ha subido ningún archivo.'], 400);
    }

    /**
     * Mostrar un posteo específico.
     */
    public function show($id)
    {
        // Cargar el posteo con usuario
        $posteo = Posteo::with('usuario')->findOrFail($id);
        return view('posteos.show', compact('posteo'));
    }

    /**
     * Mostrar formulario para editar posteo.
     */
    public function edit(Posteo $posteo)
    {
        // Solo el autor puede editar
        if ($posteo->usuario_id !== Auth::id()) {
            abort(403, 'No autorizado');
        }

        return view('posteos.edit', compact('posteo'));
    }

    /**
     * Actualizar un posteo.
     */
    public function update(Request $request, Posteo $posteo)
    {
        // Solo el autor puede actualizar
        if ($posteo->usuario_id !== Auth::id()) {
            abort(403, 'No autorizado');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'extracto' => 'nullable|string|max:500',
            'imagen_destacada' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8048',
            'estado' => 'in:borrador,publicado,archivado',
            'categoria' => 'nullable|string|max:255',
            'etiquetas' => 'nullable|string|max:255',
            'fecha_publicacion' => 'nullable|date',
        ]);

        // Lógica para manejar la imagen destacada
        if ($request->has('remove_imagen_destacada') && $request->input('remove_imagen_destacada') == '1') {
            // Eliminar la imagen si existe
            if ($posteo->imagen_destacada && Storage::disk('public')->exists($posteo->imagen_destacada)) {
                Storage::disk('public')->delete($posteo->imagen_destacada);
            }
            $posteo->imagen_destacada = null;
        } elseif ($request->hasFile('imagen_destacada')) {
            // Eliminar la imagen antigua antes de subir la nueva
            if ($posteo->imagen_destacada && Storage::disk('public')->exists($posteo->imagen_destacada)) {
                Storage::disk('public')->delete($posteo->imagen_destacada);
            }
            $path = $request->file('imagen_destacada')->store('posteos', 'public');
            $posteo->imagen_destacada = $path;
        }

        // Procesar etiquetas a un array
        $etiquetasArray = $request->input('etiquetas') ? explode(',', $request->input('etiquetas')) : null;

        $posteo->update([
            'titulo' => $request->titulo,
            // No actualizamos el slug para no romper enlaces existentes
            'contenido' => $request->contenido,
            'extracto' => $request->extracto,
            'estado' => $request->estado,
            'categoria' => $request->categoria_id,
            'etiquetas' => $etiquetasArray,
            'fecha_publicacion' => $request->fecha_publicacion,
        ]);

        return redirect()->route('posteo.index')->with('success', 'Posteo actualizado correctamente.');
    }

    /**
     * Eliminar un posteo.
     */
    public function destroy(Posteo $posteo)
    {
        if ($posteo->usuario_id !== Auth::id()) {
            abort(403, 'No autorizado');
        }

        // Eliminar también la imagen asociada
        if ($posteo->imagen_destacada && Storage::disk('public')->exists($posteo->imagen_destacada)) {
            Storage::disk('public')->delete($posteo->imagen_destacada);
        }

        $posteo->delete();
        return redirect()->route('posteo.index')->with('success', 'Posteo eliminado correctamente.');
    }
}
