<?php

namespace App\Http\Controllers;

use App\Exports\stockMinimoExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use App\Models\Productos;
use Maatwebsite\Excel\Facades\Excel;

class ReporteStockMinimo extends Controller
{
    public function index()
    {
        return view('venta/repoteStockMinimo');
    }

    public function generarPDF(Request $request)
    {
        // Obtén el stock mínimo del componente Livewire
        $stockMinimo = $request->input('stockMinimo');

        // Obtén los productos con stock menor o igual al stock mínimo
        if (isset($stockMinimo)) {
            $productos = Productos::where('stock_producto', '<=', $stockMinimo)->get();
        } else {
            $productos = Productos::whereRaw('stock_producto <= stockMinimo_producto')->get();
        }

        // Genera el PDF y lo envía al navegador
        $pdf = PDF::loadView('pdf.stockMinimoPDF', compact('productos'));
        return $pdf->stream();
    }

    public function generarExcel(Request $request)
    {
        $stockMinimo = $request->input('stockMinimo');

        // Obtén los productos con stock menor o igual al stock mínimo
        if (isset($stockMinimo)) {
            $productos = Productos::where('stock_producto', '<=', $stockMinimo)->get();
        } else {
            $productos = Productos::whereRaw('stock_producto <= stockMinimo_producto')->get();
        }
        return Excel::download(new stockMinimoExport($productos), 'reporte_stock_minimo.xlsx');
    }
}
