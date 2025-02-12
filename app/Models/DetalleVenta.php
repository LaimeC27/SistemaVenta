<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;
    protected $fillable = ['idVenta', 'idProducto', 'cantidad', 'precio', 'subtotal'];

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'productoid');
    }

   
}
