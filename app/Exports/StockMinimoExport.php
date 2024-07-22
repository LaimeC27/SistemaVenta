<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class stockMinimoExport implements FromView, ShouldAutoSize,WithEvents
{
    protected $productos;

    public function __construct($productos)
    {
        $this->productos = $productos;
    }

    public function view(): View
    {
        return view('pdf.stockMinimoPDF', [
            'productos' => $this->productos
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $highestRow = $event->sheet->getHighestRow();
                $cellRange = 'A1:G' . $highestRow; // All cells
                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }

}


