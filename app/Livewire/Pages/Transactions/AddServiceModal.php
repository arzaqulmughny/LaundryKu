<?php

namespace App\Livewire\Pages\Transactions;

use Livewire\Attributes\On;
use Livewire\Component;

class AddServiceModal extends Component
{
    public bool $show = false;

    #[On('show-add-service-modal')]
    public function showModal()
    {
        $this->show = true;
    }

    #[On('hide-add-service-modal')]
    public function hideModal()
    {
        $this->show = false;
    }
    
    public function render()
    {
        return view('livewire.pages.transactions.add-service-modal');
    }
}
