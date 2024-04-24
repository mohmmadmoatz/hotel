<?php

namespace App\Http\Livewire\Admin\Servicecategory;

use App\Models\Servicecategory;
use Livewire\Component;

class Single extends Component
{

    public $servicecategory;

    public function mount(Servicecategory $Servicecategory){
        $this->servicecategory = $Servicecategory;
    }

    public function delete()
    {
        $this->servicecategory->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Servicecategory') ]) ]);
        $this->emit('servicecategoryDeleted');
    }

    public function render()
    {
        return view('livewire.admin.servicecategory.single')
            ->layout('admin::layouts.app');
    }
}
