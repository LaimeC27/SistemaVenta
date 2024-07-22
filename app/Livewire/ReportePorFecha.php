<?php

namespace App\Livewire;

use App\Models\Ventas;
use Livewire\Component;
use Livewire\WithPagination;

class ReportePorFecha extends Component
{
    public $fecha;
    public $fecha2;


    use WithPagination;

    public function render()
    {
        $ventas = $this->buscarVentasPorFecha();
        return view('livewire.reporte-por-fecha', compact('ventas'));
    }

    public function buscarFechas()
    {
        $this->validate([
            'fecha' => 'required|date',
            'fecha2' => 'required|date|after_or_equal:fecha',
        ]);

        $this->render(); // Esto renderizará la vista, pero no ejecutará la búsqueda
    }

    private function buscarVentasPorFecha()
    {
        $query = Ventas::query();

        // Si las fechas son iguales, busca ventas para ese día específico
        if ($this->fecha && $this->fecha2 && $this->fecha == $this->fecha2) {
            $query->whereDate('created_at', $this->fecha);
        } else if ($this->fecha && $this->fecha2) {
            $query->whereBetween('created_at', [$this->fecha, $this->fecha2]);
        }
        $query->orderByDesc('created_at');

        return $query->paginate(11);
    }
}
