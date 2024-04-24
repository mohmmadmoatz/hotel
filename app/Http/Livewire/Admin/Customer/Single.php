<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Customer;
use Livewire\Component;

class Single extends Component
{

    public $customer;

    public function mount(Customer $Customer){
        $this->customer = $Customer;
    }

    public function delete()
    {
        $this->customer->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Customer') ]) ]);
        $this->emit('customerDeleted');
    }

    public function render()
    {
        return view('livewire.admin.customer.single')
            ->layout('admin::layouts.app');
    }
}
