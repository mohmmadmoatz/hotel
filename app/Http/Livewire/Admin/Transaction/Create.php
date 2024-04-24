<?php

namespace App\Http\Livewire\Admin\Transaction;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

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

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    function mount() {
        $this->date = date('Y-m-d');
    }

    public function create()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Transaction') ])]);
        
        $this->amount = str_replace(',', '', $this->amount);

        Transaction::create([
            'details' => $this->details,
            'type' => $this->type,
            'amount' => $this->amount,
            'date' => $this->date, 
            'user_id' => auth()->user()->id,           
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.transaction.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Transaction') ])]);
    }
}
