<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Material;

class SelectMaterialTable extends DataTableComponent
{
    protected $model = Material::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([5]);
        $this->setPerPage(5);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nama", "name")
                ->sortable(),
            Column::make("Satuan", "unit")
                ->sortable(),
            Column::make("Aksi")
                ->label(function ($row) {
                    return view('components.button', [
                        'slot' => '+ Pilih',
                        'attributes' => new \Illuminate\View\ComponentAttributeBag([
                            'onclick' => "onSelectMaterial(" . htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') . ")",
                        ]),
                    ]);
                })
                ->html()
        ];
    }
}
