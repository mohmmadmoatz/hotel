<?php

namespace App\Http\Livewire\Admin\Bookednow;

use App\Models\Bookednow;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $bookednow;

    
    protected $rules = [
        
    ];

    public function mount(Bookednow $bookednow){
        $this->bookednow = $bookednow;
        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Bookednow') ]) ]);
        
        $this->bookednow->update([
            
        ]);
    }

    public function render()
    {
        return view('livewire.admin.bookednow.update', [
            'bookednow' => $this->bookednow
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Bookednow') ])]);
    }
}
