<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    //datos necesarios para subir image
    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'imagen',
        'precio'
    ];
}
