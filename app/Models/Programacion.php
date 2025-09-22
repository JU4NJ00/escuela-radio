<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programacion extends Model
{
    protected $table = 'programaciones'; // 👈 le decimos a Eloquent el nombre real
    protected $fillable = ['programa_id','dia_semana','hora_inicio','hora_fin'];

    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }
}

