<?php

namespace App\Http\Livewire\Admin\Expense;

use App\Models\Expense;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $expense;

    public $category_id;
    public $amount;
    public $date;
    public $description;
    
    protected $rules = [
        'amount' => 'required',
        'date' => 'required',
        'description' => 'required',        
    ];

    public function mount(Expense $Expense){
        $this->expense = $Expense;
        $this->category_id = $this->expense->category_id;
        $this->amount = $this->expense->amount;
        $this->date = $this->expense->date;
        $this->description = $this->expense->description;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Expense') ]) ]);
        
        $this->amount = str_replace(',', '', $this->amount);

        
        $this->expense->update([
            'category_id' => $this->category_id,
            'amount' => $this->amount,
            'date' => $this->date,
            'description' => $this->description,            
        ]);

        $transaction = Transaction::where('expense_id', $this->expense->id)->first();
        if($transaction)
        $transaction->update([
            'amount' => $this->amount,
            'date' => $this->date,
            'details' => $this->description,              
        ]);

    }

    public function render()
    {
        return view('livewire.admin.expense.update', [
            'expense' => $this->expense
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Expense') ])]);
    }
}
