<?php

namespace App\Http\Livewire\Admin\Expense;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Read extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    protected $queryString = ['search'];

    protected $listeners = ['expenseDeleted'];

    public $sortType;
    public $sortColumn;

    public $category_id;

    public $total=0;

    public function expenseDeleted(){
        // Nothing ..
    }

    public function sort($column)
    {
        $sort = $this->sortType == 'desc' ? 'asc' : 'desc';

        $this->sortColumn = $column;
        $this->sortType = $sort;
    }

    function getData() {
        $data = Expense::query();

        $instance = getCrudConfig('expense');
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

        if($this->category_id){
            $data= $data->where("category_id",$this->category_id);
        }

        if($this->sortColumn) {
            $data->orderBy($this->sortColumn, $this->sortType);
        } else {
            $data->latest('id');
        }

        return $data;
    }

    function getDataProperty() {
        $this->total = $this->getData()->sum('amount');
        return $this->getData()->paginate(config('easy_panel.pagination_count', 15));
    }

    public function render()
    {
     
        

       

        return view('livewire.admin.expense.read', [
            'expenses' => $this->data
        ])->layout('admin::layouts.app', ['title' => __(\Str::plural('Expense')) ]);
    }
}
