<?php

namespace App\Http\Livewire\Admin\Expensecategory;

use App\Models\Expensecategory;
use Livewire\Component;

class Single extends Component
{

    public $expensecategory;

    public function mount(Expensecategory $Expensecategory){
        $this->expensecategory = $Expensecategory;
    }

    public function delete()
    {
        $this->expensecategory->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Expensecategory') ]) ]);
        $this->emit('expensecategoryDeleted');
    }

    public function render()
    {
        return view('livewire.admin.expensecategory.single')
            ->layout('admin::layouts.app');
    }
}
