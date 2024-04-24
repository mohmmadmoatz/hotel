<?php

namespace App\Http\Livewire\Admin\Prebook;

use App\Models\Prebook;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $prebook;

    public $name;
    public $room_id;
    public $book_date;
    public $details;
    
    protected $rules = [
        'name' => 'required',
        'room_id' => 'required',
        'book_date' => 'required',        
    ];

    public function mount(Prebook $Prebook){
        $this->prebook = $Prebook;
        $this->name = $this->prebook->name;
        $this->room_id = $this->prebook->room_id;
        $this->book_date = $this->prebook->book_date;
        $this->details = $this->prebook->details;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Prebook') ]) ]);
        
        $this->prebook->update([
            'name' => $this->name,            'room_id' => $this->room_id,            'book_date' => $this->book_date,            'details' => $this->details,            
        ]);
    }

    public function render()
    {
        return view('livewire.admin.prebook.update', [
            'prebook' => $this->prebook
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Prebook') ])]);
    }
}
