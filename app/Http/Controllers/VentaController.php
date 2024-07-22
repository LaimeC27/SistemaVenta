<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\DetalleVenta;
use App\Models\Productos;
use App\Models\Ventas;
use App\Models\empresaDatos;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Codedge\Fpdf\Facades\Fpdf;


class VentaController extends Controller
{
    public function index()
    {
        return view('venta.ventas');
    }

    public function edit()
    {
        return view('venta.listaVentas');
    }

    public function create()
    {
        return view('venta.listaVentas');
    }


    public function GenerarPDF($boleta, $numero)
    {
        $venta = Ventas::where('nboleta', $boleta)->first();
        $cliente = Clientes::find($venta->clienteid);
        $detalle_ventas = DetalleVenta::where('idventa', $venta->id)->get();
        $empresa = empresaDatos::first();
    
        // Configuración inicial
        Fpdf::AddPage('P', [80, 200]); // Tamaño de la página
    
        // Usar Arial en lugar de DejaVu Sans
        Fpdf::SetFont('Arial', '', 10);
    
        // Función para codificar correctamente el texto
        $encode = function ($text) {
            return iconv('UTF-8', 'windows-1252//TRANSLIT', $text);
        };
    
        // Encabezado del ticket
        Fpdf::Cell(0, 5, $encode($empresa->nombre_empresa), 0, 1, 'C');
        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(0, 4, 'RUP: ' . $encode($empresa->rup), 0, 1, 'C');
        Fpdf::Cell(0, 4, 'Telefono: ' . $encode($empresa->telefono), 0, 1, 'C');
        Fpdf::Cell(0, 4, 'Direccion: ' . $encode($empresa->direccion), 0, 1, 'C');
        Fpdf::Cell(0, 4, 'Correo: ' . $encode($empresa->correo_empresa), 0, 1, 'C');
    
        // Datos de la venta
        Fpdf::Ln(5);
        Fpdf::Cell(60, 4, 'Cliente: ' . $encode($cliente->nombreCliente), 0, 1);
        Fpdf::Cell(60, 4, 'Boleta: ' . $encode($venta->nboleta), 0, 1);
        Fpdf::Cell(60, 4, 'Fecha: ' . $venta->created_at->format('d-m-Y - H:i:s'), 0, 1);
    
        // Columnas
        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(30, 10, $encode('Producto'), 0);
        Fpdf::Cell(5, 10, 'Cant.', 0, 0, 'R');
        Fpdf::Cell(10, 10, 'Precio', 0, 0, 'R');
        Fpdf::Cell(15, 10, 'Total', 0, 0, 'R');
        Fpdf::Ln(8);
        Fpdf::Cell(60, 0, '', 'T');
        Fpdf::Ln(0);
    
        // Productos
        Fpdf::SetFont('Arial', '', 8);
        foreach ($detalle_ventas as $detalle_venta) {
            $producto = Productos::find($detalle_venta->productoid);
    
            // Ajustar la descripción del producto
            Fpdf::SetX(10); // Establecer posición X
            $descripcion = $encode($producto->descripcion);
            $yBefore = Fpdf::GetY();
            Fpdf::MultiCell(30, 4, $descripcion, 0, 'L');
            $yAfter = Fpdf::GetY();
            $alturaDescripcion = $yAfter - $yBefore;
    
            // Ajustar la posición para la cantidad, precio y total
            Fpdf::SetXY(40, $yBefore); // Establecer posición X para cantidad
            Fpdf::Cell(5, $alturaDescripcion, $detalle_venta->cantidad, 0, 0, 'R');
            Fpdf::Cell(10, $alturaDescripcion, ($producto->precio_venta) . ' /S', 0, 0, 'R');
            Fpdf::Cell(15, $alturaDescripcion, ($detalle_venta->cantidad * $producto->precio_venta) . ' ', 0, 1, 'R');
            Fpdf::Ln(2);
        }
    
        Fpdf::Ln(6);
        Fpdf::Cell(60, 0, '', 'T');
        Fpdf::Ln(2);
    
        Fpdf::Cell(35, 10, 'SUBTOTAL', 0);
        Fpdf::Cell(10, 10, '', 0);
        Fpdf::Cell(15, 10, ($venta->monto - $venta->igv) . ' /S', 0, 1, 'R');
    
        Fpdf::Cell(35, 10, 'I.V.A. 18%', 0);
        Fpdf::Cell(10, 10, '', 0);
        Fpdf::Cell(15, 10, $venta->igv . ' /S', 0, 1, 'R');
    
        Fpdf::Cell(35, 10, 'TOTAL', 0);
        Fpdf::Cell(10, 10, '', 0);
        Fpdf::Cell(15, 10, $venta->total . ' /S', 0, 1, 'R');
    
        Fpdf::Ln(10);
        Fpdf::Cell(0, 5, $encode('¡Gracias por tu compra!'), 0, 1, 'C');
        Fpdf::Cell(0, 5, $encode('Vuelve pronto.'), 0, 1, 'C');
    
        $boleta = "Boleta_" . $venta->nboleta . ".pdf";
    
        if ($numero == 1) {
            Fpdf::Output('I', $boleta);
        } else {
            Fpdf::Output('D', $boleta);
        }
    
        exit;
    }
    

}
