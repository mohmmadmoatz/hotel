<?php

namespace App\Http\Livewire\Admin\Prebook;

use App\Models\Prebook;
use Livewire\Component;

class Single extends Component
{

    public $prebook;

    public function mount(Prebook $Prebook){
        $this->prebook = $Prebook;
    }

    public function delete()
    {
        $this->prebook->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Prebook') ]) ]);
        $this->emit('prebookDeleted');
    }

    public function render()
    {
        return view('livewire.admin.prebook.single')
            ->layout('admin::layouts.app');
    }
}
