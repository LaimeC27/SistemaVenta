<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empresaDatos extends Model
{
    use HasFactory;
  
    protected $fillable = ['nombre_empresa','direccion','telefono','rup','correo_empresa'];
}
