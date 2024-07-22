<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventas;

class PrincipalController extends Controller
{
    public function index()
    {
        // Obtén tus datos de ventas de la base de datos
        $ventasData = Ventas::all();

        // Pasa los datos a la vista
        return view('venta.principal', compact('ventasData'));
    }
}
