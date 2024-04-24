<?php

namespace App\Http\Livewire\Admin\Booking;

use App\Models\Booking;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Report extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public $from_date;
    public $to_date;

    protected $queryString = ['search','from_date','to_date'];

    protected $listeners = ['bookingDeleted'];

    public $sortType;
    public $sortColumn;


    

    public function searchBydate($date)
    {
        # code...
        $this->daterange = $date;
        $this->datefilterON = true;
    }

    public function bookingDeleted(){
        // Nothing ..
    }

    public function sort($column)
    {
        $sort = $this->sortType == 'desc' ? 'asc' : 'desc';

        $this->sortColumn = $column;
        $this->sortType = $sort;
    }

    function getDaysFromRange($range) {
        
        $dates = array();
        $date = explode(" - ", $range);
        $start = strtotime($date[0]);
        $end = strtotime($date[1]);
        $dates[] = date('Y-m-d', $start);
        while($start < $end) {
            $start = strtotime("+1 day", $start);
            $dates[] = date('Y-m-d', $start);
        }
        return $dates;

    }

    function mount() {
        if(!$this->from_date)
        $this->from_date = date("Y-m-01");
        $this->to_date = date("Y-m-d");
    }

    public function render()
    {
      

        // get days from date range
        $days = [];
        if($this->from_date){
            $days = $this->getDaysFromRange($this->from_date." - ".$this->to_date);
            $days = array_values($days);

            
        $transactionsIncome = Transaction::where("type","add")->whereBetween('date', [$this->from_date, $this->to_date])
        ->selectRaw('sum(amount) as sum, date')
        ->groupBy('date')->get();

        $transactionsOutcome = Transaction::where("type","sub")->whereBetween('date', [$this->from_date, $this->to_date])
        ->selectRaw('sum(amount) as sum, date')
        ->groupBy('date')->get();

       $totalIncome = Transaction::where("type","add")->whereBetween('date', [$this->from_date, $this->to_date])->sum("amount");
       $totalOutcome = Transaction::where("type","sub")->whereBetween('date', [$this->from_date, $this->to_date])->sum("amount");

       $datasets = [];

       foreach ($days as $day) {
           
            $datasets[] = $transactionsIncome->where("date",$day)->first()->sum ?? 0;
           
       }

       $datasets2 = [];

       foreach ($days as $day) {
           
            $datasets2[] = $transactionsOutcome->where("date",$day)->first()->sum ?? 0;
       }

       $datasets = array_values($datasets);
       $datasets2 = array_values($datasets2);

     

        

        }




        return view('livewire.admin.bookednow.report', [
           "days"=>$days,
              "datasets"=>$datasets ?? [],
                "datasets2"=>$datasets2 ??[],
                "totalIncome"=>$totalIncome ?? 0,
                "totalOutcome"=>$totalOutcome ??0,
        ])->layout('admin::layouts.app', ['title' => "التقرير العام" ]);
    }
}
