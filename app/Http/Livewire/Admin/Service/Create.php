<?php

namespace App\Http\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $category_id;
    public $name;
    public $price;
    
    protected $rules = [
        'name' => 'required',
        'price' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Service') ])]);
        
        Service::create([
            'category_id' => $this->category_id,
            'name' => $this->name,
            'price' => $this->price,
            'user_id' => auth()->id(),
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.service.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Service') ])]);
    }
}
