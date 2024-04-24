<?php

namespace App\Http\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $service;

    public $category_id;
    public $name;
    public $price;
    
    protected $rules = [
        'name' => 'required',
        'price' => 'required',        
    ];

    public function mount(Service $Service){
        $this->service = $Service;
        $this->category_id = $this->service->category_id;
        $this->name = $this->service->name;
        $this->price = $this->service->price;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Service') ]) ]);
        
        $this->service->update([
            'category_id' => $this->category_id,
            'name' => $this->name,
            'price' => $this->price,
            'user_id' => auth()->id(),
        ]);
    }

    public function render()
    {
        return view('livewire.admin.service.update', [
            'service' => $this->service
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Service') ])]);
    }
}
