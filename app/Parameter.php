<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    
    protected $fillable = [
        'nombre',
        'abreviatura',
        'unidad_medida',
        'descripcion'
    ];
}
