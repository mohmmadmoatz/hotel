<?php

namespace App\Http\Livewire\Admin\Servicecategory;

use App\Models\Servicecategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $servicecategory;

    public $name;
    public $printer;
    
    protected $rules = [
        'name' => 'text',        
    ];

    public function mount(Servicecategory $Servicecategory){
        $this->servicecategory = $Servicecategory;
        $this->name = $this->servicecategory->name;
        $this->printer = $this->servicecategory->printer;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Servicecategory') ]) ]);
        
        $this->servicecategory->update([
            'name' => $this->name,            'printer' => $this->printer,            
        ]);
    }

    public function render()
    {
        return view('livewire.admin.servicecategory.update', [
            'servicecategory' => $this->servicecategory
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Servicecategory') ])]);
    }
}
