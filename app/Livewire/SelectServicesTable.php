<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Service;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ComponentColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class SelectServicesTable extends DataTableComponent
{
    protected $model = Service::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPrimaryKey('id');
        $this->setPerPageVisibilityDisabled(); // hilangkan dropdown per page
        $this->setPerPageAccepted([5]);        // daftar perPage yang diijinkan
        $this->setPerPage(5);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nama", "name")
                ->searchable()
                ->sortable(),
            Column::make("Harga", "price")
                ->searchable()
                ->sortable(),
            Column::make("Deskipsi", "description")
                ->searchable()
                ->sortable(),
            Column::make("Satuan", "unit")
                ->sortable(),
            Column::make("Aksi")
                ->label(function ($row) {
                    return view('components.button', [
                        'slot' => '+ Pilih',
                        'attributes' => new \Illuminate\View\ComponentAttributeBag([
                            'wire:click' => "\$dispatch('select-service', {id: {$row->id}})",
                        ]),
                    ]);
                })
                ->html(),
        ];
    }
}
