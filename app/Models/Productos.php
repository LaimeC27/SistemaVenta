<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorias;

class Productos extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigoProducto',
        'id_categoria',
        'descripcion',
        'precio_compra',
        'precio_venta',
        'stock_producto',
        'stockMinimo_producto'
    ];

    public function categorias()
    {
        return $this->belongsTo(Categorias::class, 'id_categoria');
    }
    
    

}
