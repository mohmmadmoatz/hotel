<?php

namespace App\Http\Livewire\Admin\Expense;

use App\Models\Expense;
use Livewire\Component;

class Single extends Component
{

    public $expense;

    public function mount(Expense $Expense){
        $this->expense = $Expense;
    }

    public function delete()
    {
        $this->expense->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Expense') ]) ]);
        $this->emit('expenseDeleted');
    }

    public function render()
    {
        return view('livewire.admin.expense.single')
            ->layout('admin::layouts.app');
    }
}
