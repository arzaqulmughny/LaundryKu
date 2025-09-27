<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RevenuesExport implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    protected $revenues;

    public function __construct($revenues)
    {
        $this->revenues = $revenues;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->revenues->map(function ($revenue) {
            return [
                'transaction_date' => $revenue->transaction_date,
                'total_revenue' => $revenue->total_revenue
            ];
        });
    }

    public function title(): string
    {
        return 'Laporan Pendapatan';
    }

    public function headings(): array
    {
        return [
            [$this->title()],
            [],
            [
                'Tanggal',
                'Jumlah',
            ]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 14]], // baris pertama bold + besar
            3 => ['font' => ['bold' => true]], // header tabel bold
        ];
    }
}
