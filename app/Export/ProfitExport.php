<?php

namespace App\Export;

use App\Models\Profits;
use App\Models\ProfitsData;
use App\Models\Routes;
use App\Models\User;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;

class ProfitExport implements FromView, WithStyles, WithColumnWidths
{

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 60,
            'C' => 10,
            'D' => 10,
            'E' => 15,
            'F' => 10,
            'G' => 10,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        //        $sheet->getStyle('B5')->getFont()->setBold(true);
        $sheet->getRowDimension(1)->setRowHeight(-1);
        $sheet->getRowDimension(3)->setRowHeight(-1);
        $sheet->getRowDimension(4)->setRowHeight(-1);
        $sheet->getRowDimension(7)->setRowHeight(-1);
        return [
            'A1' => ['font' => ['size' => 24, 'bold' => true], 'alignment' => ['horizontal' => 'center']],
            'A2' => ['alignment' => ['horizontal' => 'center']],
            'A3' => ['alignment' => ['horizontal' => 'center']],
            'A4' => ['alignment' => ['horizontal' => 'center']],
            // 'A3' => ['font' => ['size' => 14], 'alignment' => ['horizontal' => 'center', 'vertical' => 'justify', 'wrapText' => true]],
            '6' => ['font' => ['bold' => true]],
        ];
    }

    public function view(): View
    {
        return view('exports.profit', [
            'User' => User::find($this->id),
        ]);
    }
}
