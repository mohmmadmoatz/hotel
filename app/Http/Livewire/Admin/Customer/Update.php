<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $customer;

    public $name;
    public $phone;
    public $city;
  
    public $nat;
    public $idf;
    public $id_date;
    public $borndate;
    public $gender;
    
    protected $rules = [
        'name' => 'required',
        'phone' => 'required',
        'city' => 'required',
            
    ];

    public function mount(Customer $Customer){
        $this->customer = $Customer;
        $this->name = $this->customer->name;
        $this->phone = $this->customer->phone;
        $this->city = $this->customer->city;
          
        $this->nat =  $this->customer->nat;     
        $this->idf =  $this->customer->idf;     
        $this->id_date =  $this->customer->id_date;     
        $this->borndate =  $this->customer->borndate;     
        $this->gender =  $this->customer->gender;     
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Customer') ]) ]);
        
        $this->customer->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'city' => $this->city,

            'nat' => $this->nat,
            'idf' => $this->idf,
            'id_date' => $this->id_date,
            'borndate' => $this->borndate,
            'gender' => $this->gender,
                        
        ]);
    }

    public function render()
    {
        return view('livewire.admin.customer.update', [
            'customer' => $this->customer
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Customer') ])]);
    }
}
