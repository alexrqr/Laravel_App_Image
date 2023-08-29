<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'descripcion',
        'imagen',
        'precio'
    ];

    /* Codigo de referencia:
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion', 'imagen']; */
}
