<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Categorias;
use App\Models\Productos;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProductoCrearComponente extends Component
{
    use WithFileUploads;

    public $codigo;
    public $categoria = "";
    public $descripcion;
    public $precioCompra;
    public $precioVenta;
    public $stockProducto;
    public $stockMinimo;
    public $botonVisible = false;
    public $productoId;

    public $imagenProducto;

    public $isUploaded = false;

    public function render()
    {
        $categorias = Categorias::all();
        return view('livewire.producto-crear-componente', ['categorias' => $categorias]);
    }

    public function save()
    {
        $this->validate([
            'codigo' => ['required', 'unique:productos,codigoProducto'],
            'categoria' => 'required',
            'descripcion' => 'required',
            'precioCompra' => ['required', 'regex:/^-?[0-9]+(\.[0-9]{1,2})?$/'],
            'precioVenta' => ['required', 'regex:/^-?[0-9]+(\.[0-9]{1,2})?$/'],
            'stockProducto' => 'required',
            'stockMinimo' => 'required',
            'imagenProducto' => ['nullable', 'image', 'max:1024'],
        ], [
            'precioCompra.regex' => 'El campo precio de compra debe ser un número decimal con punto (.) y no con coma (,)',
            'precioVenta.regex' => 'El campo precio de venta debe ser un número decimal con punto (.) y no con coma (,)',
        ]);

        $producto = Productos::create([
            'codigoProducto' => $this->codigo,
            'id_categoria' => $this->categoria,
            'descripcion' => $this->descripcion,
            'precio_compra' => $this->precioCompra,
            'precio_venta' => $this->precioVenta,
            'stock_producto' => $this->stockProducto,
            'stockMinimo_producto' => $this->stockMinimo,
        ]);

        if ($this->imagenProducto) {
            $nombreImagen = $this->imagenProducto->getClientOriginalName();
            $this->imagenProducto->storeAs('imagenes', $nombreImagen);
            $producto->imagenProducto = $nombreImagen;
            $producto->save();
        }else{
            $producto->imagenProducto = 'imagenDefecto.png';
            $producto->save();
        }


        $this->limpiar();
        $this->dispatch('CreacionCorrecta', 'Se ha creado el producto correctamente');
        $this->inicioProducto();
    }


    public function limpiar()
    {
        $this->codigo = "";
        $this->categoria = "";
        $this->descripcion = "";
        $this->precioCompra = "";
        $this->precioVenta = "";
        $this->stockProducto = "";
        $this->stockMinimo = "";
    }
    public function inicioProducto()
    {
        return redirect()->route('productos.index');
    }


    public function mount()
    {
        if (session()->has('producto')) {
            $producto = session()->get('producto');
            $this->productoId = $producto['id'];
            $this->codigo = $producto['codigo'];
            $this->categoria = $producto['categoria'];
            $this->descripcion = $producto['descripcion'];
            $this->precioCompra = $producto['precioCompra'];
            $this->precioVenta = $producto['precioVenta'];
            $this->stockProducto = $producto['stockProducto'];
            $this->stockMinimo = $producto['stockMinimo'];
            $this->imagenProducto = $producto['imagenProducto'];
            session()->forget('producto');
            $this->ocultarBoton();
            $this->isUploaded = true;
        }
    }

    public function ocultarBoton()
    {
        $this->botonVisible  = true;
    }

    public function mostrarBoton()
    {
        $this->botonVisible  = false;
    }

    public function actualizar()
    {
        $this->validate([
            'codigo' => ['required', Rule::unique('productos', 'codigoProducto')->ignore($this->productoId)],
            'categoria' => 'required',
            'descripcion' => 'required',
            'precioCompra' => ['required', 'regex:/^-?[0-9]+(\.[0-9]{1,2})?$/'],
            'precioVenta' => ['required', 'regex:/^-?[0-9]+(\.[0-9]{1,2})?$/'],
            'stockProducto' => 'required',
            'stockMinimo' => 'required',
        ], [
            'precioCompra.regex' => 'El campo precio de compra debe ser un número decimal con punto (.) y no con coma (,)',
            'precioVenta.regex' => 'El campo precio de venta debe ser un número decimal con punto (.) y no con coma (,)',
        ]);

        $producto = Productos::find($this->productoId);
        $producto->codigoProducto = $this->codigo;
        $producto->id_categoria = $this->categoria;
        $producto->descripcion = $this->descripcion;
        $producto->precio_compra = $this->precioCompra;
        $producto->precio_venta = $this->precioVenta;
        $producto->stock_producto = $this->stockProducto;
        $producto->stockMinimo_producto = $this->stockMinimo;

        if ($this->imagenProducto instanceof \Illuminate\Http\UploadedFile) {
            if (Storage::exists('imagenes/' . $producto->imagenProducto)) {
                Storage::delete('imagenes/' . $producto->imagenProducto);
            }

            $nombreImagen = $this->imagenProducto->getClientOriginalName();
            $this->imagenProducto->storeAs('imagenes', $nombreImagen);
            $producto->imagenProducto = $nombreImagen;
        }

        $producto->save();

        $this->limpiar();
        $this->dispatch('CreacionCorrecta', 'Se ha actualizado el producto correctamente');
        $this->inicioProducto();
    }
}
