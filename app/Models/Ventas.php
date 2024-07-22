<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
    protected $fillable = ['idCliente', 'idUsuario', 'numeroVenta', 'total', 'efectivoRecibido', 'vuelto', 'falta', 'igv', 'estado'];
    public function DetalleVenta()
    {
        return $this->hasMany(DetalleVenta::class, 'idventa');
    }
    
    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'clienteid');
    }
  
}
