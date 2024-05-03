<?php

namespace App\Http\Livewire\Admin\Incomecat;

use App\Models\Incomecat;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $incomecat;

    public $name;
    
    protected $rules = [
        'name' => 'required',        
    ];

    public function mount(Incomecat $incomecat){
        $this->incomecat = $incomecat;
        $this->name = $this->Incomecat->name;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Incomecat') ]) ]);
        
        $this->incomecat->update([
            'name' => $this->name,            
        ]);
    }

    public function render()
    {
        return view('livewire.admin.incomecat.update', [
            'incomecat' => $this->incomecat
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Incomecat') ])]);
    }
}
