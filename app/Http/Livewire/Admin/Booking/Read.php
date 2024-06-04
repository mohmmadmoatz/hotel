<?php

namespace App\Http\Livewire\Admin\Booking;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Read extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    protected $queryString = ['search'];

    protected $listeners = ['bookingDeleted'];

    public $sortType;
    public $sortColumn;

    public function bookingDeleted(){
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
        $data = Booking::query();

        $instance = getCrudConfig('booking');
        if($instance->searchable()){
            $array = (array) $instance->searchable();
            $data->where(function (Builder $query) use ($array){
                foreach ($array as $item) {
                    if(!\Str::contains($item, '.')) {
                        $query->orWhere($item, 'like', '%' . $this->search . '%');
                    } else {
                        $array = explode('.', $item);
                        $query->orWhereHas($array[0], function (Builder $query) use ($array) {
                            $query->where($array[1], 'like', '%' . $this->search . '%');
                        });
                    }
                }
                $query->orWhereHas('guests', function (Builder $query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
            });
        }

       

        if($this->sortColumn) {
            $data->orderBy($this->sortColumn, $this->sortType);
        } else {
            $data->latest('id');
        }



        $data = $data->paginate(config('easy_panel.pagination_count', 15));

        return view('livewire.admin.booking.read', [
            'bookings' => $data
        ])->layout('admin::layouts.app', ['title' => __(\Str::plural('Booking')) ]);
    }
}
