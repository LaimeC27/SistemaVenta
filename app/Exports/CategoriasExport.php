<?php

namespace App\Exports;

use App\Models\Categorias;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class CategoriasExport implements FromView, ShouldAutoSize, WithEvents
{
    
    public function view(): View
    {
        return view('pdf.categoriaPDF',[
            'categorias'=>Categorias::all()
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
