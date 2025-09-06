<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Service;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn;

class ServicesTable extends DataTableComponent
{
    protected $model = Service::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('services.edit', $row->id);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nama", "name")
                ->searchable()
                ->sortable(),
            Column::make("Deskripsi", "description")
                ->searchable()
                ->sortable(),
            Column::make("Harga", "price")
                ->sortable(),
            Column::make("Satuan", "unit")
                ->searchable()
                ->sortable(),
            BooleanColumn::make("Aktif", "active")
                ->searchable()
                ->sortable(),
            DateColumn::make("Tanggal Dibuat", "created_at")
                ->sortable(),
            DateColumn::make("Tanggal Diupdate", "updated_at")
                ->sortable(),
        ];
    }
}
