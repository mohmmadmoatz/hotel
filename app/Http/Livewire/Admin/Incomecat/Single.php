<?php

namespace App\Http\Livewire\Admin\Incomecat;

use App\Models\Incomecat;
use Livewire\Component;

class Single extends Component
{

    public $incomecat;

    public function mount(Incomecat $Incomecat){
        $this->incomecat = $Incomecat;
    }

    public function delete()
    {
        $this->incomecat->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Incomecat') ]) ]);
        $this->emit('incomecatDeleted');
    }

    public function render()
    {
        return view('livewire.admin.incomecat.single')
            ->layout('admin::layouts.app');
    }
}
