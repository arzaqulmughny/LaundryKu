<?php

namespace App\Livewire\Pages\Transactions;

use Livewire\Attributes\On;
use Livewire\Component;

class AddPayModal extends Component
{
    public $show = false, $date, $amount = 0;

    #[On('show-modal')]
    public function showModal()
    {
        $this->show = true;
        $this->date = now()->format('Y-m-d');
    }

    #[On('hide-modal')]
    public function hideModal()
    {
        $this->reset();
    }
    
    public function submit()
    {
        $this->dispatch('add-pay', date: $this->date, amount: $this->amount)->to(Create::class);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.pages.transactions.add-pay-modal');
    }
}
