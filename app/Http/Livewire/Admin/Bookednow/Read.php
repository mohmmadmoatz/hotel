<?php

namespace App\Http\Livewire\Admin\Bookednow;

use App\Models\Bookednow;
use App\Models\Room;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Read extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    protected $queryString = ['search'];

    protected $listeners = ['bookednowDeleted'];

    public $sortType;
    public $sortColumn;

    public function bookednowDeleted(){
        // Nothing ..
    }

    public function sort($column)
    {
        $sort = $this->sortType == 'desc' ? 'asc' : 'desc';

        $this->sortColumn = $column;
        $this->sortType = $sort;
    }

    public function render()
    {
        $rooms = Room::query();

        $rooms = $rooms->get();


       

        return view('livewire.admin.bookednow.read', [
            'rooms' => $rooms
        ])->layout('admin::layouts.app', ['title' => "الأستقبال" ]);
    }
}
