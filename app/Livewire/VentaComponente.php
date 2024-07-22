<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Clientes;
use App\Models\Productos;
use App\Models\Ventas;
use App\Models\DetalleVenta;


class VentaComponente extends Component
{
    use WithPagination;

    public $cliente = '';
    public $resultados = [];
    public $productosSeleccionados = [];
    public $cantidad = 1;
    public $efectivoRecibido = 0;
    public $search = "";


    public function render()
    {
        $clientes = Clientes::all();
        $ultimaVenta = Ventas::orderBy('created_at', 'desc')->first();
        $productos = Productos::where('descripcion', 'like', '%' . $this->search . '%')
            ->orWhere('codigoProducto', 'like', '%' . $this->search . '%')
            ->orderByDesc('id')
            ->paginate(20);

        return view('livewire.venta-componente', compact('clientes', 'productos', 'ultimaVenta'));
    }


    public function agregarProducto($id)
    {
        $producto = Productos::find($id);

        // Verificar si el stock del producto es 0
        if ($producto->stock_producto == 0) {
            $this->dispatch('MensajeError', 'no hay stock de producto');
            return;
        }

        // Si el producto ya está en la lista, incrementamos la cantidad
        if (array_key_exists($id, $this->productosSeleccionados)) {
            // Verificar si la cantidad es mayor al stock
            if ($this->productosSeleccionados[$id]['cantidad'] + 1 > $producto->stock_producto) {
                $this->dispatch('MensajeError', 'no hay stock de producto');
                return;
            }
            $this->productosSeleccionados[$id]['cantidad']++;
        } else {
            // Si el producto no está en la lista, lo agregamos con cantidad 1
            $this->productosSeleccionados[$id] = [
                'id' => $producto->id,
                'descripcion' => $producto->descripcion,
                'precio_venta' => $producto->precio_venta,
                'cantidad' => 1
            ];
        }
    }

    public function calcularTotal()
    {
        $montoTotal = 0;

        foreach ($this->productosSeleccionados as $producto) {
            $montoTotal += $producto['precio_venta'] * $producto['cantidad'];
        }

        $igv = $montoTotal * 0.18;
        $total = $montoTotal + $igv;
        $vuelto = $this->efectivoRecibido >= $total ? $this->efectivoRecibido - $total : 0;
        $falta = floatval($this->efectivoRecibido) <= floatval($total) ? floatval($total) - floatval($this->efectivoRecibido) : 0;
        return [
            'montoTotal' => $montoTotal,
            'igv' => $igv,
            'total' => $total,
            'vuelto' => $vuelto,
            'falta' => $falta
        ];
    }
    public function actualizarCantidad($id, $cantidad)
    {
        $producto = Productos::find($id);

        // Verificar si la cantidad es mayor al stock
        if ($cantidad > $producto->stock_producto) {
            $this->dispatch('MensajeError', 'No hay suficiente stock de producto. Stock disponible: ' . $producto->stock_producto);
            $this->productosSeleccionados[$id]['cantidad'] = $producto->stock_producto;
            return;
        }

        // Si el producto ya está en la lista, actualizamos la cantidad
        if (array_key_exists($id, $this->productosSeleccionados)) {
            $this->productosSeleccionados[$id]['cantidad'] = $cantidad;
        }
    }

    public function registrarVenta()
    {

        $this->validate([
            'cliente' => 'required',
        ]);

        // Calcular el total
        $calculos = $this->calcularTotal();

        // Crear una nueva venta
        $venta = new Ventas;
        $detalleVenta = new DetalleVenta;

        $venta->nboleta = $this->incrementarBoleta();
        $venta->clienteid = $this->cliente;
        $venta->total = $calculos['total'];
        $venta->igv = $calculos['igv'];
        $venta->monto = $calculos['total'];
        $venta->save();

        // Crear los detalles de la venta
        foreach ($this->productosSeleccionados as $producto) {
            $detalleVenta = new DetalleVenta;
            $detalleVenta->productoid = $producto['id'];
            $detalleVenta->idventa = $venta->id;
            $detalleVenta->cantidad = $producto['cantidad'];
            $detalleVenta->subtotal = $calculos['montoTotal'];
            $detalleVenta->save();

            // Actualizar la cantidad del producto en el inventario
            $productoInventario = Productos::find($producto['id']);
            $productoInventario->stock_producto -= $producto['cantidad'];
            $productoInventario->save();
        }

        $this->productosSeleccionados = [];
        $this->dispatch('printPdf', ['boleta' => $venta->nboleta]);

        $this->dispatch('CreacionCorrecta', 'Se ha creado la venta correctamente');
        $this->dispatch('clienteUpdated');


        return redirect()->route('venta.GenerarPDF', ['boleta' => $venta->nboleta, 'numero' => 0]);
        //return $this->dispatch('ventaCreated', ['boleta' => $venta->nboleta]);
    }

    public function incrementarBoleta()
    {
        // Obtén la última venta
        $venta = Ventas::orderBy('created_at', 'desc')->first();

        if ($venta) {
            // Obten el número de boleta y conviértelo a entero
            $numeroBoleta = intval($venta->nboleta);

            // Incrementa el número de boleta
            $numeroBoleta++;

            // Rellena con ceros a la izquierda hasta tener 7 dígitos
            $nuevoNumeroBoleta = str_pad($numeroBoleta, 7, "0", STR_PAD_LEFT);
        } else {
            // Si no hay ventas, establece el número de boleta inicial
            $nuevoNumeroBoleta = '0000001';
        }

        return $nuevoNumeroBoleta;
    }


    public function CancelarBoleta()
    {
        $this->productosSeleccionados = [];
        $this->efectivoRecibido = 0;
        $this->cliente = null;
        $this->dispatch('clienteUpdated');
    }
    public function eliminarProducto($id)
    {
        // Check if the product is in the selected products list
        if (array_key_exists($id, $this->productosSeleccionados)) {
            // Remove the product from the selected products list
            unset($this->productosSeleccionados[$id]);
        }
    }

    public function incrementarCantidad($productoId)
    {
        if (isset($this->productosSeleccionados[$productoId])) {
            $this->productosSeleccionados[$productoId]['cantidad']++;
        }
    }

    public function decrementarCantidad($productoId)
    {
        if (isset($this->productosSeleccionados[$productoId])) {
            if ($this->productosSeleccionados[$productoId]['cantidad'] > 1) {
                $this->productosSeleccionados[$productoId]['cantidad']--;
            } else {
                $this->eliminarProducto($productoId);
            }
        }
    }
}
