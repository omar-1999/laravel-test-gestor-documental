<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'area_id' ,
        'nombre',
        'archivo',
        'fecha',
        'activo',
        'created_at',
        'updated_at'
    ];
}
