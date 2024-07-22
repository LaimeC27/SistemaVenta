<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Milon\Barcode\DNS1D;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Productos;
use App\Exports\CategoriasExport;
use App\Exports\ProductosExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductosController extends Controller
{
    public $barcode;

    public function index()
    {
        return view("venta/producto");
    }


    public function create()
    {
        return view("venta/productoCrear");
    }

    public function barcode()
    {
        return view("pdf/productoBarras");
    }

    public function generateBarcode($id)
    {
        $producto = Productos::find($id);
        $barcode = DNS1D::getBarcodeHTML($producto->codigoProducto, 'C39');
        // $datosProducto = "ID: " . $producto->id . ", Código: " . $producto->codigoProducto . ", ID Categoría: " . $producto->id_categoria . ", Descripción: " . $producto->descripcion . ", Precio Compra: " . $producto->precio_compra . ", Precio Venta: " . $producto->precio_venta . ", Stock: " . $producto->stock_producto . ", Stock Mínimo: " . $producto->stockMinimo_producto . ", Ventas: " . $producto->ventas_producto; 
        $pdf = PDF::loadView('pdf.productoBarras', compact('producto', 'barcode'));
        return $pdf->stream();
    }

    public function generatecode()
    {
        $productos = Productos::all();
        $barcodes = [];

        foreach ($productos as $producto) {
            $barcode = DNS1D::getBarcodeHTML($producto->codigoProducto, 'C39');
            $barcodes[] = [
                'producto' => $producto,
                'barcode' => $barcode,
            ];
        }

        $pdf = PDF::loadView('pdf.productoBarras', compact('barcodes'));
        return $pdf->stream();
    }

    public function generarPDF()
    {
        $productos = Productos::all();
        $pdf = PDF::loadView('pdf.productoReporte', compact('productos'));
        return $pdf->stream();
    }

    public function generarExcel()
    {
        return Excel::download(new ProductosExport, 'productos.xlsx');
    }



    /* 
   public function generateBarcode($id)
    {
        $producto = Productos::find($id);
    
        // Obtener los primeros 12 dígitos del código de producto
        $codigoProducto = substr($producto->codigoProducto, 0, 12);
    
        // Generar el código de barras EAN-13
        $barcode = DNS1D::getBarcodeHTML($codigoProducto, 'EAN13');
    
        // Cargar la vista PDF con los datos
        $pdf = PDF::loadView('pdf.productoBarras', compact('producto', 'barcode'));
    
        // Mostrar el PDF
        return $pdf->stream();
    }
    */

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
