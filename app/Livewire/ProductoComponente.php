<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Productos;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ProductoComponente extends Component
{
    use WithPagination;

    public $producto;
    public $codigo;
    public $categoria = "";
    public $descripcion;
    public $precioCompra;
    public $precioVenta;
    public $stockProducto;
    public $stockMinimo;
    public $search = "";
    public $barcode;


    public function render()
    {
        $producto = Productos::where('descripcion', 'like', '%' . $this->search . '%')
            ->orWhere('id', 'like', '%' . $this->search . '%')
            ->orWhere('stock_producto', 'like', '%' . $this->search . '%')

            ->orWhereHas('categorias', function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%');
            })
            ->orderByDesc('id')
            ->paginate(8);

        return view('livewire.producto-componente', ['productos' => $producto]);
    }

    public function deleteConfirm($id)
    {
        $this->producto = $id;
        $this->dispatch('deleteConfirm');
    }

    public function delete()
    {
        $producto = Productos::find($this->producto);
        if ($producto) {
            if (Storage::exists('imagenes/' . $producto->imagenProducto)) {
                Storage::delete('imagenes/' . $producto->imagenProducto);
            }
            $producto->delete();
        }
    }

    public function edit($id)
    {
        $producto = Productos::find($id);

        session()->put('producto', [
            'id' => $producto->id,
            'codigo' => $producto->codigoProducto,
            'categoria' => $producto->id_categoria,
            'descripcion' => $producto->descripcion,
            'precioCompra' => $producto->precio_compra,
            'precioVenta' => $producto->precio_venta,
            'stockProducto' => $producto->stock_producto,
            'stockMinimo' => $producto->stockMinimo_producto,
            'imagenProducto' => $producto->imagenProducto,
        ]);

        return redirect()->route('productos.create');
    }
}
