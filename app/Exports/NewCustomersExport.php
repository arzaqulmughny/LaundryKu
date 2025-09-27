<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class NewCustomersExport implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    protected $newCustomers;

    public function __construct($newCustomers)
    {
        $this->newCustomers = $newCustomers;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->newCustomers->map(function ($newCustomer) {
            return [
                'date' => $newCustomer->date,
                'count' => $newCustomer->count
            ];
        });
    }

    public function title(): string
    {
        return 'Laporan Pelanggan Baru';
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
