<?php

namespace App\Livewire;

use App\Models\DetalleVenta;
use App\Models\Ventas;
use Livewire\Component;

class ListaVentaComponente extends Component
{

    public $search = '';

    public function render()
    {
        $ventas = Ventas::where('nboleta', 'like', '%' . $this->search . '%')
            ->orWhereHas('cliente', function ($query) {
                $query->where('nombreCliente', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(11);

        return view('livewire.lista-venta-componente', ['ventas' => $ventas]);
    }
}
