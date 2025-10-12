<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Material;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class MaterialsTable extends DataTableComponent
{
    protected $model = Material::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('materials.edit', $row->id);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable()
                ->sortable(),
            Column::make("Nama", "name")
                ->searchable()
                ->sortable(),
            Column::make('Harga Terakhir', 'last_price')
                ->sortable(),
            Column::make('Tersedia', 'available_stock')
                ->sortable(),
            Column::make('Satuan', 'unit')
                ->searchable()
                ->sortable(),
            BooleanColumn::make('Aktif', 'active')
                ->sortable(),
        ];
    }
}
