<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosteoController;
use App\Http\Controllers\DashboardController; // Asegúrate de importar tu controlador
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\ProgramacionController;
use App\Http\Controllers\RadioPublicController;



// Página principal de la radio (iframe player o lo que tengas en radio.blade.php)
Route::get('/radio', [RadioPublicController::class, 'index'])->name('radio');


Route::get('/show', function () {
    return view('show');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de Posteos con vistas
    // Rutas de Posteo con vistas (SINGULAR)
    Route::get('/posteo', [PosteoController::class, 'index'])->name('posteo.index');
    Route::get('/posteo/create', [PosteoController::class, 'create'])->name('posteo.create');
    Route::post('/posteo', [PosteoController::class, 'store'])->name('posteo.store');
    Route::get('/posteo/{id}', [PosteoController::class, 'show'])->name('posteo.show');
    Route::get('/posteo/{posteo}/edit', [PosteoController::class, 'edit'])->name('posteo.edit');
    Route::put('/posteo/{posteo}', [PosteoController::class, 'update'])->name('posteo.update');
    Route::delete('/posteo/{posteo}', [PosteoController::class, 'destroy'])->name('posteo.destroy');

    // 🌟 Nueva ruta para la subida de imágenes de CKEditor 🌟
    Route::post('/posteo/upload-image', [PosteoController::class, 'uploadImageFromEditor'])->name('posteo.upload.image');


    /*
    GET     /posteos           -> index
    GET     /posteos/create    -> create
    POST    /posteos           -> store
    GET     /posteos/{id}      -> show
    GET     /posteos/{id}/edit -> edit
    PUT     /posteos/{id}      -> update
    DELETE  /posteos/{id}      -> destroy
    */

    // ==========================
    //  Grupo Radio
    // ==========================
    Route::prefix('radio')->name('radio.')->group(function () {
        // Programas
        Route::resource('programas', ProgramaController::class);


        // Programaciones
        Route::resource('programaciones', ProgramacionController::class);
    });
});

require __DIR__ . '/auth.php';
