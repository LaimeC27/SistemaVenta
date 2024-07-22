<?php

namespace App\Http\Controllers;

use App\Exports\listaVentasExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Ventas;
use Maatwebsite\Excel\Facades\Excel;

class ListaVentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('venta.listaVentas');
    }

    public function generarPDF()
    {
        $ventas = Ventas::all();
        $pdf = PDF::loadView('pdf.listaVentasPDF', compact('ventas'));
        return $pdf->stream();
    }

    public function generarExcel()
    {
        return Excel::download(new listaVentasExport, 'listaVentas.xlsx');
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
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
