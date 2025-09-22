<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    protected $fillable = ['nombre','descripcion','conductor','imagen'];


    public function programaciones()
    {
        return $this->hasMany(Programacion::class);
    }
}

