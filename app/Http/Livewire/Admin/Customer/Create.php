<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $phone;
    public $city;
    public $details;
    
    protected $rules = [
        'name' => 'required',
        'phone' => 'required',
        'city' => 'required',
        'details' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Customer') ])]);
        
        Customer::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'city' => $this->city,
            'details' => $this->details,            
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.customer.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Customer') ])]);
    }
}
