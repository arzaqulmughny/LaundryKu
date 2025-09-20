<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Transaction;
use Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn;

class TransactionTable extends DataTableComponent
{
    protected $model = Transaction::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('transactions.edit', $row->id);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            DateColumn::make("Tanggal", "date")
                ->sortable(),
            DateColumn::make("Tanggal Harus Selesai", "due_date")
                ->sortable(),
            Column::make("Pelanggan", "customer.name")
                ->searchable()
                ->sortable(),
            Column::make("Admin", 'admin.name'),
            Column::make("Status", "status")
                ->sortable()
                ->format(fn ($value, $row) => $row->status_label)
        ];
    }
}
