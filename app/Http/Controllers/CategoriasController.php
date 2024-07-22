<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\CategoriasExport;
use Maatwebsite\Excel\Facades\Excel;


class CategoriasController extends Controller
{

    public function index()
    {
        return view("venta.categoria");
    }

    public function generarPDF()
    {
        $categorias = Categorias::all();
        $pdf = PDF::loadView('pdf.categoriaPDF', compact('categorias'));
        return $pdf->stream();
    }

    public function generarExcel()
    {
        return Excel::download(new CategoriasExport, 'categorias.xlsx');
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
