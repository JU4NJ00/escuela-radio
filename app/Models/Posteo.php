<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posteo extends Model
{
    use HasFactory;

    protected $table = 'posteos';

    protected $fillable = [
        'usuario_id',
        'titulo',
        'slug',
        'contenido',
        'extracto',
        'imagen_destacada',
        'estado',
        'categoria',
        'etiquetas',
        'fecha_publicacion',
    ];

    protected $casts = [
        'imagen_destacada' => 'string',
        'etiquetas' => 'array',
        'fecha_publicacion' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
