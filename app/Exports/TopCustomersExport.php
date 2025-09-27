<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TopCustomersExport implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    protected $topCustomers;

    public function __construct($topCustomers)
    {
        $this->topCustomers = $topCustomers;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->topCustomers->map(function ($topCustomer) {
            return [
                'customer' => $topCustomer->customer->name,
                'total_amount' => $topCustomer->total_amount,
                'transaction_count' => $topCustomer->transaction_count,
                'last_transaction_date' => Carbon::parse($topCustomer->last_transaction_date)->format('d-m-Y'),
            ];
        });
    }

    public function title(): string
    {
        return 'Laporan Pelanggan Terbaik';
    }

    public function headings(): array
    {
        return [
            [$this->title()],
            [],
            [
                'Pelanggan',
                'Nominal',
                'Jumlah Transaksi',
                'Tgl. Transaksi Terakhir',
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
