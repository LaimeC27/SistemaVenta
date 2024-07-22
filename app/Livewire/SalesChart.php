<?php

// app/Http/Livewire/SalesChart.php

namespace App\Livewire;

use App\Models\DetalleVenta;
use App\Models\Ventas;
use Livewire\Component;

class SalesChart extends Component
{
    public function render()
    {
        $detalleVentas = DetalleVenta::all();
        $ventas = Ventas::all();

        $labels = $ventas->pluck('nboleta');
        $data = $ventas->pluck('total');

        return view('livewire.sales-chart', [
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
