<?php

// app/Http/Livewire/PrincipalComponente.php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Productos;
use App\Models\Clientes;
use App\Models\DetalleVenta;
use App\Models\Categorias;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Ventas;

class PrincipalComponente extends Component
{
    public $cantidadProductos;
    public $cantidadClientes;
    public $ventasPorDia;
    public $totalVentasHoy;
    public $stockMinimo;
    public $productosMasVendidosPorMes;
    public $ventasRecientes;

    public function mount()
    {
        $this->cantidadProductos = $this->totalProductos();
        $this->cantidadClientes = $this->totalClientes();
        $this->totalVentasHoy = $this->calcularTotalVentasHoy();
        $this->stockMinimo = $this->stockMinimo();
        $this->ventasPorDia = $this->calcularVentasPorSemana();
        $this->productosMasVendidosPorMes = $this->calcularProductosMasVendidosPorMes();
        $this->ventasRecientes = $this->ventaRecientes();
    }


    public function render()
    {
        $labels = $this->ventasPorDia->pluck('fecha')->toJson(); // Convertir etiquetas a JSON
        $data = $this->ventasPorDia->pluck('total_por_dia')->toJson(); // Convertir datos a JSON
        $datosTotal = $this->calcularTotalDeDatos(); // Obtener los totales de datos
        return view('livewire.principal-componente', compact('labels', 'data', 'datosTotal'));
    }


    public function totalProductos()
    {
        $productos = Productos::all();
        $cantidadProductos = 0;
        foreach ($productos as $producto) {
            $cantidadProductos++;
        }
        return $cantidadProductos;
    }

    public function totalClientes()
    {
        $clientes = Clientes::all();
        $cantidadClientes = 0;
        foreach ($clientes as $cliente) {
            $cantidadClientes++;
        }
        return $cantidadClientes;
    }

    public function calcularTotalVentasHoy()
    {
        $totalVentasHoy = Ventas::whereDate('created_at', Carbon::today())->sum('total');

        return $totalVentasHoy;
    }

    public function stockMinimo()
    {
        $productosStockMinimo = Productos::whereColumn('stock_producto', '<=', 'stockMinimo_producto')
            ->select('descripcion', 'stock_producto')
            ->take(10)
            ->get();
        return $productosStockMinimo;
    }

    public function calcularVentasPorSemana()
    {
        // Obtener la fecha del inicio de la semana actual (lunes)
        $inicioSemana = Carbon::now()->startOfWeek()->toDateString();
    
        // Obtener la fecha del final de la semana actual (domingo)
        $finSemana = Carbon::now()->endOfWeek()->toDateString();
    
        // Obtener las ventas de la semana actual y sumarlas
        $ventasPorSemana = Ventas::whereBetween('created_at', [$inicioSemana, $finSemana])
            ->selectRaw('DATE(created_at) as fecha, SUM(total) as total_por_dia')
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();
    
        // Si hoy es lunes, restablecer las ventas a cero
        if (Carbon::now()->isMonday()) {
            $ventasPorSemana = 0;
        }
    
        return $ventasPorSemana;
    }

    public function calcularProductosMasVendidosPorMes()
    {
       

            $productosMasVendidosPorMes = DetalleVenta::selectRaw('MONTH(dv.created_at) as mes, YEAR(dv.created_at) as anio, dv.productoid, SUM(dv.cantidad) as total_cantidad, p.descripcion as descripcion_producto, p.precio_venta as precio_producto')
            ->from('detalle_ventas as dv')
            ->groupBy('mes', 'anio', 'dv.productoid', 'descripcion_producto', 'precio_producto') // Incluimos las columnas de descripción y precio en el GROUP BY
            ->orderBy('anio')
            ->orderBy('mes')
            ->orderByDesc('total_cantidad')
            ->join('productos as p', 'dv.productoid', '=', 'p.id')
            ->take(10)
            ->get();
        return $productosMasVendidosPorMes;
    }

    public function ventaRecientes()
    {
        $ventas = Ventas::orderBy('created_at', 'desc')->take(5)->get();
        return $ventas;
    }

    public function calcularTotalDeDatos()
    {
        $productoTotal = Productos::all()->count();
        $clienteTotal = Clientes::all()->count();
        $categoriaTotal = Categorias::all()->count();
        $ventasTotal = Ventas::all()->count();

        return [
            'productos' => $productoTotal,
            'clientes' => $clienteTotal,
            'categorias' => $categoriaTotal,
            'ventas' => $ventasTotal
        ];
    }


    /*
     public function calcularVentasPorDia()
    {
        // Obtener el rango de fechas para el reporte
        $fechaInicio = Carbon::now()->startOfMonth();
        $fechaFin = Carbon::now();

        // Consulta para obtener las ventas totales por día
        $ventasPorDia = Ventas::select(DB::raw('DATE(created_at) as fecha'), DB::raw('SUM(total) as total_por_dia'))
            ->whereBetween('created_at', [$fechaInicio, $fechaFin])
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();

        // Crear un arreglo que contendrá todos los días del rango con sus respectivos totales de ventas
        $ventasPorDiaCompleto = [];
        $fechaActual = clone $fechaInicio;
        while ($fechaActual <= $fechaFin) {
            $fecha = $fechaActual->format('Y-m-d');
            $totalPorDia = $ventasPorDia->firstWhere('fecha', $fecha);
            $ventasPorDiaCompleto[$fecha] = $totalPorDia ? $totalPorDia->total_por_dia : 0;
            $fechaActual->addDay();
        }

        return $ventasPorDiaCompleto;
    }
     */
}
