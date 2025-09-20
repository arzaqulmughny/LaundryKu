<?php

namespace App\Livewire\Pages\Transactions;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class Table extends Component
{
    #[Reactive]
    public $services, $showActions = true;

    public function mount($showActions = true)
    {
        $this->showActions = $showActions;
    }

    public function getTotal()
    {
        return collect($this->services)->sum(function ($service) {
            return (int) $service['service_price'] * (int) $service['quantity'];
        });
    }

    public function getSubtotalIndex($index)
    {
        return (int) $this->services[$index]['service_price'] * (int) $this->services[$index]['quantity'];
    }


    /**
     * Get formatted total in Rupiah currency
     */
    public function getFormattedTotal(): string
    {
        $formatter = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->getTotal(), 'IDR');
    }

    public function render()
    {
        return view('livewire.pages.transactions.table');
    }
}
