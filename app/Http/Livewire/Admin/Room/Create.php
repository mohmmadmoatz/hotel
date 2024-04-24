<?php

namespace App\Http\Livewire\Admin\Room;

use App\Models\Room;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $room_type;
    public $price;
    
    protected $rules = [
        'name' => 'required',
        'room_type' => 'required',
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

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Room') ])]);
        
        Room::create([
            'name' => $this->name,            'room_type' => $this->room_type,            'price' => $this->price,            
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.room.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Room') ])]);
    }
}
