<?php

namespace App\Http\Livewire\Admin\Room;

use App\Models\Room;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $room;

    public $name;
    public $room_type;
    public $price;
    
    protected $rules = [
        'name' => 'required',
        'room_type' => 'required',
        'price' => 'required',        
    ];

    public function mount(Room $Room){
        $this->room = $Room;
        $this->name = $this->room->name;
        $this->room_type = $this->room->room_type;
        $this->price = $this->room->price;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Room') ]) ]);
        
        $this->room->update([
            'name' => $this->name,            'room_type' => $this->room_type,            'price' => $this->price,            
        ]);
    }

    public function render()
    {
        return view('livewire.admin.room.update', [
            'room' => $this->room
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Room') ])]);
    }
}
