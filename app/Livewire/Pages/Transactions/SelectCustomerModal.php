<?php

namespace App\Livewire\Pages\Transactions;

use Livewire\Attributes\On;
use Livewire\Component;

class SelectCustomerModal extends Component
{
    public $show = false;

    #[On('showModal')]
    public function showModal()
    {
        $this->show = true;
    }
    
    public function hideModal()
    {
        $this->show = false;
    }

    #[On('select')]
    public function onSelect($id = null)
    {
        $this->show = false;

        if ($id) {
            $this->dispatch('select-customer', id: $id)->to(Create::class);
        }
    }

    public function render()
    {
        return view('livewire.pages.transactions.select-customer-modal');
    }
}
