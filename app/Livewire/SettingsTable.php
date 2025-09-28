<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Setting;

class SettingsTable extends DataTableComponent
{
    protected $model = Setting::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('settings.edit', $row->id);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nama", "label")
                ->sortable(),
            Column::make("Nilai")
                ->label(function ($row) {
                    return $row->value ?? $row->default_value;
                })
        ];
    }
}
