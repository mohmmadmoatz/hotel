<?php

namespace App\Http\Livewire\Admin\Incomecat;

use App\Models\Incomecat;
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

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Incomecat') ])]);
        
        Incomecat::create([
            'name' => $this->name,            
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.incomecat.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Incomecat') ])]);
    }
}
