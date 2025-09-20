<?php

namespace App\Livewire\Pages\Transactions;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Customer;
use Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn;

class SelectCustomerTable extends DataTableComponent
{
    protected $model = Customer::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
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
            Column::make("Aksi")
                ->label(function ($row) {
                    return view('components.button', [
                        'slot' => '+ Pilih',
                        'attributes' => new \Illuminate\View\ComponentAttributeBag([
                            'wire:click' => "\$dispatch('select', {id: {$row->id}})",
                        ]),
                    ]);
                })
                ->html(),
        ];
    }
}
