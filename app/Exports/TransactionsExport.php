<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionsExport implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    protected $transactions;

    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->transactions->map(function ($transaction) {
            return [
                'date' => Carbon::parse($transaction->date)->format('d-m-Y'),
                'due_date' => $transaction->due_date,
                'customer' => $transaction->customer->name,
                'created_by' => $transaction->admin->name,
                'status' => $transaction->status_label
            ];
        });
    }

    public function title(): string
    {
        return 'Laporan Transaksi';
    }

    public function headings(): array
    {
        return [
            [$this->title()],
            [],
            [
                'Tanggal',
                'Tgl. Diambil',
                'Pelanggan',
                'Admin',
                'Status'
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
