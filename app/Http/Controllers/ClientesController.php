<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\clientesExport;
use App\Models\Clientes;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ClientesController extends Controller
{
    public function index()
    {
        return view("venta/clientes");
    }

    public function create()
    {
        return view("venta/clienteCrear");
    }

    public function generarPDF()
    {
        $clientes = Clientes::all();
        $pdf = PDF::loadView('pdf.clienteReporte', compact('clientes'));
        return $pdf->stream();
    }

    public function generarExcel()
    {
        return Excel::download(new clientesExport, 'clientes.xlsx');
    }
    
}
