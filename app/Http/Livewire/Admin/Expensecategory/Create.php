<?php

namespace App\Http\Livewire\Admin\Expensecategory;

use App\Models\Expensecategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    
    protected $rules = [
        'name' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Expensecategory') ])]);
        
        Expensecategory::create([
            'name' => $this->name,            
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.expensecategory.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Expensecategory') ])]);
    }
}
