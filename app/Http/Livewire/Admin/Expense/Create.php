<?php

namespace App\Http\Livewire\Admin\Expense;

use App\Models\Expense;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $category_id;
    public $amount;
    public $date;
    public $description;
    
    protected $rules = [
        'amount' => 'required',
        'date' => 'required',
        'description' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function mount(){
        $this->date = date('Y-m-d');
    }

    public function create()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Expense') ])]);
        
        $this->amount = str_replace(',', '', $this->amount);

       $exp =  Expense::create([
            'category_id' => $this->category_id,
            'amount' => $this->amount,
            'date' => $this->date,
            'description' => $this->description,            
        ]);

        Transaction::create([
            'type' => 'add',
            'amount' => $this->amount,
            'date' => $this->date,
            'details' => $this->description,            
            'expense_id' => $exp->id,            
        ]);


        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.expense.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Expense') ])]);
    }
}
