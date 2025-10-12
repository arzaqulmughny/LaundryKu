<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Unit;

class UnitsTable extends DataTableComponent
{
    protected $model = Unit::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('units.edit', $row->id);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Kode", "code")
                ->sortable(),
            Column::make("Nama", "name")
                ->sortable(),
        ];
    }
}
