<?php

namespace App\Http\Livewire\Admin\Prebook;

use App\Models\Prebook;
use Livewire\Component;
use Livewire\WithFileUploads;
use DateTime;
use DateInterval;
class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $room_id;
    public $book_date;
    public $details;
    
    public $err = false;

    public $warn = "";

    protected $rules = [
        'name' => 'required',
        'room_id' => 'required',
        'book_date' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {

        if($this->err)
        return;

        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Prebook') ])]);
        
        Prebook::create([
            'name' => $this->name,            'room_id' => $this->room_id,            'book_date' => $this->book_date,            'details' => $this->details,            
        ]);


        $this->reset();
    }

    public function render()
    {


        if($this->book_date){
            $therebooking = Prebook::where("book_date",$this->book_date)->where("room_id",$this->room_id)->first();
            
            if($therebooking){
                $this->err = true;
            }else{
                $this->err = false;
            }

           $bookDate = new DateTime($this->book_date);
         
           $dayAfter = $bookDate->add(new DateInterval('P1D'))->format('Y-m-d');

           $check = Prebook::
           Where("book_date",$dayAfter)
           ->where("room_id",$this->room_id)
           ->first();
          
           if($check){
            $this->warn = "تنبيه : يوجد حجز مسبق في تاريخ " . "($dayAfter)";
           }else{
            $this->warn = "";
           }



        }

        return view('livewire.admin.prebook.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Prebook') ])]);
    }
}
