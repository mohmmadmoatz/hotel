<?php

namespace App\Http\Livewire\Admin\Bookednow;

use App\Models\Bookednow;
use Livewire\Component;

class Single extends Component
{

    public $bookednow;

    public function mount(Bookednow $Bookednow){
        $this->bookednow = $Bookednow;
    }

    public function delete()
    {
        $this->bookednow->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Bookednow') ]) ]);
        $this->emit('bookednowDeleted');
    }

    public function render()
    {
        return view('livewire.admin.bookednow.single')
            ->layout('admin::layouts.app');
    }
}
