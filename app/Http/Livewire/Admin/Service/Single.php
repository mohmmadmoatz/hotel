<?php

namespace App\Http\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;

class Single extends Component
{

    public $service;

    public function mount(Service $Service){
        $this->service = $Service;
    }

    public function delete()
    {
        $this->service->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Service') ]) ]);
        $this->emit('serviceDeleted');
    }

    public function render()
    {
        return view('livewire.admin.service.single')
            ->layout('admin::layouts.app');
    }
}
