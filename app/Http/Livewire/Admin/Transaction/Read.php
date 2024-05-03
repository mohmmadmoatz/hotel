<?php

namespace App\Http\Livewire\Admin\Transaction;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Read extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    protected $queryString = ['search'];

    protected $listeners = ['transactionDeleted'];

    public $sortType;
    public $sortColumn;


    public $totalAdd =0;
    public $totalSub =0;
    
    public $user_id;

    public $selected = [];

    public $from_date;
    public $to_date;

    public function transactionDeleted(){
        // Nothing ..
    }


    function makeReport() {
            // save in session
            $sid = rand(1000, 9999);
            $data = [
                'from_date' => $this->from_date,
                'to_date' => $this->to_date,
                'user_id' => $this->user_id,
                'sid' => $sid,
                'selected'=>$this->selected
            ];
            
            // put session with name sid
            session()->put('sid'.$sid, $data);
            

            // dispatch open in new window

            $route = route('report')."?sid=".$sid;

            $this->dispatchBrowserEvent('print', ['url' => $route]);



    }

    public function sort($column)
    {
        $sort = $this->sortType == 'desc' ? 'asc' : 'desc';

        $this->sortColumn = $column;
        $this->sortType = $sort;
    }


    function getData() {
        
        $data = Transaction::query();

        $instance = getCrudConfig('transaction');
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
            });
        }

        if($this->sortColumn) {
            $data->orderBy($this->sortColumn, $this->sortType);
        } else {
            $data->latest('id');
        }

        if($this->user_id){
            $data= $data->where("user_id",$this->user_id);
        }

        return $data;

    }

    // get data property

    public function getDataProperty()
    {
        $data = $this->getData();

        $this->totalAdd = $this->getData()->where('type', 'add')->sum('amount');
        $this->totalSub = $this->getData()->where('type', 'sub')->sum('amount');

        return $this->getData()->paginate(config('easy_panel.pagination_count', 15));
    }


    public function render()
    {
       

        


        

        return view('livewire.admin.transaction.read', [
            'transactions' => $this->data
        ])->layout('admin::layouts.app', ['title' => __(\Str::plural('Transaction')) ]);
    }
}
