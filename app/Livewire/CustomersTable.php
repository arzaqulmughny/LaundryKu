<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Customer;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn;

class CustomersTable extends DataTableComponent
{
    protected $model = Customer::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('customers.edit', $row->id);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id"),
            Column::make("Nama", "name")
                ->searchable()
                ->sortable(),
            Column::make("No. Hp", "phone")
                ->searchable()
                ->sortable(),
            Column::make("Email", "email")
                ->searchable()
                ->sortable(),
            Column::make("Alamat", "address")
                ->searchable()
                ->sortable(),
            BooleanColumn::make('Aktif', 'active')
                ->sortable(),
            DateColumn::make("Tanggal Dibuat", "created_at")
                ->searchable()
                ->sortable()
                ->outputFormat('Y-m-d'),
            DateColumn::make("Tanggal Diupdate", "updated_at")
                ->searchable()
                ->sortable()
                ->outputFormat('Y-m-d'),
        ];
    }
}
