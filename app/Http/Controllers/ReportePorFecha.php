<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Ventas;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportePorFechaExport;

class ReportePorFecha extends Controller
{
    public function index()
    {
        return view('venta/reportePorFecha');
    }

    public function generarPDF(Request $request)
    {
        $fecha = $request->fecha;
        $fecha2 = $request->fecha2;

        if ($fecha == "" || $fecha2 == "") {
            $ventas = Ventas::all();
        } else {
            $ventas = Ventas::whereBetween('created_at', [$fecha, $fecha2])->get();
        }
        $pdf = PDF::loadView('pdf.reportePorFechaPDF', compact('ventas'));
        return $pdf->stream();
    }

    public function generarExcel(Request $request)
    {
        $fecha = $request->fecha;
        $fecha2 = $request->fecha2;

        if ($fecha == "" || $fecha2 == "") {
            $ventas = Ventas::all();
        } else {
            $ventas = Ventas::whereBetween('created_at', [$fecha, $fecha2])->get();
        }
        return Excel::download(new ReportePorFechaExport($ventas), 'reportePorFecha.xlsx');
    }

}
