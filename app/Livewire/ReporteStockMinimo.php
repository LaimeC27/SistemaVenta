<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Productos;
use Livewire\WithPagination;

class ReporteStockMinimo extends Component
{
    public $stockMinimo = null;
    public $search = "";

    use WithPagination;

    public function mount()
    {
        $this->stockMinimo = null;
    }

    public function render()
    {
        $productos = [];
        if (isset($this->stockMinimo)) {
            $productos = Productos::where('stock_producto', '<=', $this->stockMinimo)->paginate(16);
        } else {
            $productos = Productos::whereRaw('stock_producto <= stockMinimo_producto')->paginate(16);
        }

        return view('livewire.reporte-stock-minimo', compact('productos'));
    }


    public function buscar()
    {
        if ($this->stockMinimo === null || $this->stockMinimo === "") {
            $this->reset('stockMinimo');
            $productos = Productos::all();
        } else {
            $productos = Productos::where('stockMinimo_producto', '<=', $this->stockMinimo)->get();
        }

        return view('livewire.reporte-stock-minimo', compact('productos'));
    }
}
