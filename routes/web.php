<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ListaVentasController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\VentaController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReporteStockMinimo;
use App\Http\Controllers\ReportePorFecha;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('/Categoria', CategoriasController::class);
//Route::resource('/Producto', ProductosController::class);
Route::resource('/Cliente', ClientesController::class);

Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
Route::get('/productosCreate', [ProductosController::class, 'create'])->name('productos.create');

Route::get('/productosCodeBarras/{id}', [ProductosController::class, 'generateBarcode'])->name('productos.barcode');
Route::get('/productosCodigoBarras', [ProductosController::class, 'generatecode'])->name('productos.code');


Route::get('/categoriasPDF', [CategoriasController::class, 'generarPDF'])->name('pdf.categoriaPDF');
Route::get('/categoriasExcel', [CategoriasController::class, 'generarExcel'])->name('pdf.categoriaExcel');

Route::get('/productosPDF', [ProductosController::class, 'generarPDF'])->name('pdf.productoPDF');
Route::get('/productosExcel', [ProductosController::class, 'generarExcel'])->name('pdf.productoExcel');

Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('/clientesCreate', [ClientesController::class, 'create'])->name('clientes.create');
route::get('/clientesPDF', [ClientesController::class, 'generarPDF'])->name('pdf.clientePDF');
route::get('/clientesExcel', [ClientesController::class, 'generarExcel'])->name('pdf.clienteExcel');

Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');

Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
Route::get('/ListaVentas', [ListaVentasController::class, 'index'])->name('ListaVentas.index');

Route::get('/principal', [PrincipalController::class, 'index'])->name('principal.index');

Route::get('/venta/{boleta}/{numero}/generar-pdf', [VentaController::class, 'GenerarPDF'])->name('venta.GenerarPDF');

route::get('/listaVentaPDF', [ListaVentasController::class, 'generarPDF'])->name('pdf.listaVentasPDF');
route::get('/listaVentaExecel', [ListaVentasController::class, 'generarExcel'])->name('pdf.listaVentasExcel');

route::get('reporteStockMinimo', [ReporteStockMinimo::class, 'index'])->name('reporteStockMinimo');

Route::get('/reporteStockMinimo-pdf', [ReporteStockMinimo::class, 'generarPDF'])->name('generarStockMinimo.pdf');
Route::get('/reporteStockMinimo-excel', [ReporteStockMinimo::class, 'generarExcel'])->name('generar.StockMinimoExcel');

Route::get('/reportePorFecha', [ReportePorFecha::class, 'index'])->name('reportePorFecha');
Route::get('/reportePorFechaPDF', [ReportePorFecha::class, 'generarPDF'])->name('generarPorFecha.pdf');
Route::get('/reportePorFechaExcel', [ReportePorFecha::class, 'generarExcel'])->name('generarPorFechaExcel');

//Route::get('/generar-pdf/{stockMinimo}', [ReporteStockMinimo::class, 'generarPDF'])->name('generar.pdf');
