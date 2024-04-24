<?php

namespace App\Http\Livewire\Admin\Transaction;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $transaction;

    public $details;
    public $type;
    public $amount;
    public $date;
    
    protected $rules = [
        'details' => 'required',
        'type' => 'required',
        'amount' => 'required',
        'date' => 'required',        
    ];

    public function mount(Transaction $Transaction){
        $this->Transaction = $Transaction;
        $this->details = $this->Transaction->details;
        $this->type = $this->Transaction->type;
        $this->amount = $this->Transaction->amount;
        $this->date = $this->Transaction->date;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Transaction') ]) ]);
        $this->amount = str_replace(',', '', $this->amount);

        $this->Transaction->update([
            'details' => $this->details,
            'type' => $this->type,
            'amount' => $this->amount,
            'date' => $this->date,            
        ]);
    }

    public function render()
    {
        return view('livewire.admin.transaction.update', [
            'transaction' => $this->transaction
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Transaction') ])]);
    }
}
