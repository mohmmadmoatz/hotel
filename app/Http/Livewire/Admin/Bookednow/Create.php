<?php

namespace App\Http\Livewire\Admin\Bookednow;

use App\Models\Bookednow;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Prebook;
use Carbon\Carbon;
class Create extends Component
{
    use WithFileUploads;

    public $room;

    public $room_id;

    public $queryString = ["room_id"];

    public $guests = [];
    public $name;
    public $lastname;
    public $phone;
    public $mother_name;

    public $nat;
    public $city;
    public $idf;
    public $id_date;
    public $borndate;
    public $gender;

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

    public $modalOpen =false;

    protected $listeners = ['closeModal'];

    public $images;

    public $nearbook;

    public function closeModal()
    {
        $this->closedrop();
    }

    function setDrop() {
        $this->modalOpen=true;
    }

    function closedrop() {
        
        $this->modalOpen=false;
    }

    public function setname($name) {
        $this->name = Customer::find($name)->name;
        $this->lastname = Customer::find($name)->lastname;
        $this->phone = Customer::find($name)->phone;
        $this->mother_name = Customer::find($name)->mother_name;
        $this->closedrop();
    }

    function calcPaid() {
        $paid =0;
        foreach ($this->payments as  $item) {
            if($item['paid']){
                $paid += $item['paid'];
            }
        }
        $this->paid = $paid;
    }

    function addPaid() {

        $this->new_paid = str_replace(',', '', $this->new_paid);

        if(auth()->user()->role != "admin")
        {
                if($this->new_paid < 0 )
                return;
        }
       

        if($this->new_paid == 0)
            return;

        if(!$this->new_pay_date)
            return;

        $this->payments[] = [
            'paid' => $this->new_paid,
            'discount' => $this->new_discount,
            'pay_date' => $this->new_pay_date,
        ];

        $this->new_paid = 0;
        $this->new_discount = 0;
        $this->new_pay_date =  date("Y-m-d");
    }


     function getTotalServices() {
        $this->total_services = 0;
        foreach ($this->services as $key => $service) {
            $this->total_services += $service['service_price'] * $service['service_quantity'];
        }
    }


    function removeService($index) {
        unset($this->services[$index]);
     
    }

    function removeCustomer($index) {
        unset($this->guests[$index]);
    }

    

    function updatedService() {
        $service = \App\Models\Service::where('name',$this->service)->first();
        if($service){
            $this->service_price = $service->price;
            $this->service_quantity = 1;
        }else{
            $this->service_price = 0;
            $this->service_quantity = 0;
        }

    }

    function addService() {

        if(!$this->service)
            return;
        if(!$this->service_price)
            return;

        $this->services[] = [
            'service' => $this->service,
            'service_price' => $this->service_price,
            'service_quantity' => $this->service_quantity,
        ];

        $this->service = '';
        $this->service_price = '';
        $this->service_quantity = '';

    }


    function addCustomer() {
        
        if(!$this->name)
            return;
        if(!$this->lastname)
            return;

            $images = [];
            if($this->images)
            foreach ($this->images as $image) {
                $images[] = $image->store('images','public');
            }
            


        $this->guests[] = [
            'name' => $this->name,
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'mother_name' => $this->mother_name,
            'images' => $images,
            "nat"=>$this->nat,
            "city"=>$this->city,
            "idf"=>$this->idf,
            "id_date"=>$this->id_date,
            "borndate"=>$this->borndate,
            "gender"=>$this->gender,
        ];

        $this->name = '';
        $this->lastname = '';
        $this->phone = '';
        $this->mother_name = '';
        $this->images = [];

        $this->nat = "";
        $this->city = "";
        $this->idf = "";
        $this->id_date = "";
        $this->borndate = "";
        $this->gender = "";

    }

    
    protected $rules = [
        'room_id' => 'required|exists:rooms,id',
        'guests' => 'required|array|min:1',
        'checkin_date'=> 'required|date',
        'checkout_date'=> 'required|date|after:checkin_date',
        'days'=> 'required|numeric|min:1',
        'address'=> 'required|string',
        
    ];

    


    function checkout() {
        $this->create();
        
        $this->dispatchBrowserEvent('print', ['url' => route('checkout') . "?booking_id=" . $this->booked->booking_id]);

        Bookednow::where("booking_id",$this->booked->booking_id)->delete();
        $booking = Booking::find($this->booked->booking_id);
        $booking->status = "سابق";
        $booking->save();

        // if($this->discount > 0){
        //     $booking->payments()->create([
        //         'amount'=> $this->discount,
        //         'details'=>"تسجيل مبلغ الخصم للحجز  ".$booking->id . " | الغرفة  : " .  $this->room->name,
        //         'type'=> 'sub',
        //         'date'=> date("Y-m-d"),
        //         'account_id'=>-1
        //      ]);
        // }

        redirect()->route('admin.bookednow.read');



    }

    function maintancemode() {
        $this->room->status = 'maintance';
        $this->room->save();
        redirect()->route('admin.bookednow.read');
    }

    function exitmaintancemode() {
        $this->room->status = null;
        $this->room->save();
        redirect()->route('admin.bookednow.read');
    }

    public function mount()
    {
        $this->room = Room::find($this->room_id);
        $this->checkin_date = date("Y-m-d");
        $this->checkin_time = date("H:i");
        $this->new_pay_date = date("Y-m-d");

        $this->nearbook = Prebook::where('room_id',$this->room_id)
        ->where('book_date','<',Carbon::now()->addDays(5))
        ->where('book_date','>=',Carbon::now())
        ->first();



        $this->booked = Bookednow::where('room_id',$this->room_id)->first();
        if($this->booked){
            $booking = Booking::find($this->booked->booking_id);
            $this->checkin_date = $booking->checkin_date;
            $this->checkin_time = $booking->checkin_time;
            $this->checkout_date = $booking->checkout_date;
            $this->days = $booking->days;
            $this->notes = $booking->notes;
            $this->address = $booking->address;
            $this->reason = $booking->reason;
            $this->car = $booking->car;
            $this->carNO = $booking->carNO;
            $this->car_state = $booking->car_state;
            $this->car_color = $booking->car_color;
            $this->paid = $booking->paid;
            $this->discount = $booking->discount;
            $this->finalPrice = $booking->finalPrice;
            $this->total_services = $booking->services;
            $this->guests = $booking->guests->toArray();
            $this->services = $booking->servicesitems->toArray();
            $this->payments = $booking->payments->map(function($item){
                return [
                    'paid' => $item['amount'],
                    'discount' => 0,
                    'pay_date' => $item['date'],
                ];
            })->toArray();
            $this->calcDays();
        }

    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Bookednow') ])]);
        
        // change update to create


        $book =  Booking::updateOrCreate(
            ['id' => $this->booked ? $this->booked->booking_id : null],
            [
            'room_id' => $this->room_id,
            'checkin_date' => $this->checkin_date,
            "checkin_time" => $this->checkin_time,
            'checkout_date' => $this->checkout_date,
            'days' => $this->days,
            'notes'=> $this->notes,
            'address'=> $this->address,
            'reason'=> $this->reason,
            'car'=> $this->car,
            'carNO'=> $this->carNO,
            'car_state'=> $this->car_state,
            'car_color'=> $this->car_color,
            'price'=> $this->totalPrice,
            'netPrice'=> $this->netPrice,
            'paid'=> $this->paid,
            'discount'=> $this->discount,
            'finalPrice'=> $this->finalPrice,
            'services'=> $this->total_services,
            'status'=> 'booked',
        ]);

        if(!$this->booked){
            Bookednow::create([
                'booking_id' => $book->id,
                'room_id' => $this->room_id,
            ]);  
        }
        

        // create customers

        if($this->booked)
            $book->guests()->delete();
        foreach ($this->guests as $guest) {
            $book->guests()->create([
                'name' => $guest['name'],
                'lastname' => $guest['lastname'],
                'phone' => $guest['phone'],
                'mother_name' => $guest['mother_name'],
                "nat"=> $guest['nat'],
                "idf"=> $guest['idf'],
                "id_date"=> $guest['id_date'],
                "borndate"=> $guest['borndate'],
                "gender"=> $guest['gender'],
                "city"=> $guest['city'],
                'images' => json_encode($guest['images']),
            ]);
        }


        // create services

        if($this->booked)
            $book->servicesitems()->delete();
        foreach ($this->services as $service) {
            $book->servicesitems()->create([
                'service' => $service['service'],
                'service_price' => $service['service_price'],
                'service_quantity' => $service['service_quantity'],
            ]);
        }

        // create payments
        if($this->booked)
            $book->payments()->delete();
        foreach ($this->payments as $payment) {
            $book->payments()->create([
               'amount'=> $payment['paid'],
               'details'=>"دفعة من الحجز رقم ".$book->id . " | الغرفة  : " .  $this->room->name,
               'type'=> 'add',
               'date'=> $payment['pay_date'],
               'account_id'=>-1,
               'user_id'=>auth()->user()->id
            ]);
        }

       // $this->reset();
    }

    function calculateData() {
        $this->calcPaid();
        $this->getTotalServices();
        $this->totalPrice = $this->room->price * $this->days;
        $this->netPrice = $this->room->price * $this->days + $this->total_services;
        $this->finalPrice = $this->netPrice -  $this->paid - $this->discount;
    }


    function calcDays() {
        if($this->checkin_date && $this->checkout_date){
            $dt1 = \Carbon\Carbon::parse($this->checkin_date);
            $dt2 = \Carbon\Carbon::parse($this->checkout_date);
            $this->days =  $dt1->diffInDays($dt2);
            $this->dates = [];
            for ($i=0; $i < $this->days; $i++) { 
                $this->dates[] = [
                    "date"=>$dt1->format('Y-m-d'),
                    "paid"=>false,
                    "discount"=>0,
                ];
                $dt1->addDay();
            }
        }
    }

   

    function removePaid($index) {
        unset($this->payments[$index]);
    }

    // check if updated checkin and checkout
   public function updatedCheckoutDate() {
        $this->calcDays();
    }

    function updatedCheckinDate() {
        $this->calcDays();
    }


    




    

    public function render()
    {

        $this->calculateData();
        return view('livewire.admin.bookednow.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Bookednow') ])]);
    }
}
