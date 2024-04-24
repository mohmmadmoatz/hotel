<?php

namespace App\Http\Livewire\Admin\Booking;

use App\Models\Booking;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $booking;

    public $room;


    public $guests = [];
    public $name;
    public $lastname;
    public $phone;

    public $mother_name;

    public $checkin_date;
    public $checkin_time;
    public $checkout_date;

    public $notes;

    public $days;

   

    public $dates =[];

    public $address;
    public $reason;
    
    public $car;
    public $carNO;
    public $car_state;
    public $car_color;

    // services

    public $services = [];

    public $service;
    public $service_price;
    public $service_quantity;

    public $total_services;


    public $totalPrice;
    public $netPrice;

    public $paid = 0;

    public $discount = 0;

    public $finalPrice;

    public $booked;

    public $daydiscount;

    public $payments = [];

    public $new_paid =0;
    public $new_discount =0;
    public $new_pay_date = 0;
    
    protected $rules = [
        
    ];

    public function mount(Booking $Booking){
        $this->booking = $Booking;
        $this->room = $Booking->room;

        $this->checkin_date = $Booking->checkin_date;
        $this->checkin_time = $Booking->checkin_time;
        $this->checkout_date = $Booking->checkout_date;
        $this->days = $Booking->days;
        $this->notes = $Booking->notes;
        $this->address = $Booking->address;
        $this->reason = $Booking->reason;
        $this->car = $Booking->car;
        $this->carNO = $Booking->carNO;
        $this->car_state = $Booking->car_state;
        $this->car_color = $Booking->car_color;
        $this->paid = $Booking->paid;
        $this->discount = $Booking->discount;
        $this->finalPrice = $Booking->finalPrice;
        $this->total_services = $Booking->services;
        $this->guests = $Booking->guests->toArray();
        $this->services = $Booking->servicesitems->toArray();
        $this->payments = $Booking->payments->map(function($item){
            return [
                'paid' => $item['amount'],
                'discount' => 0,
                'pay_date' => $item['date'],
            ];
        })->toArray();
        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Booking') ]) ]);
        
        $this->booking->update([
            
        ]);
    }

    public function render()
    {
        return view('livewire.admin.booking.update', [
            'booking' => $this->booking
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Booking') ])]);
    }
}
