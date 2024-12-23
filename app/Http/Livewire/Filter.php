<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use Livewire\Component;
use App\Models\Purchase;

class Filter extends Component
{

    public $sales;
    public $purchases;
    // public $year;
    public $month;

    protected $listeners = ['filter' => 'filter'];

    public function mount(){
        $this->sales = Sale::all();
        $this->purchases = Purchase::all();
    }

    public function filter(){
        $this->purchases = Purchase::query();
        $this->sales = Sale::query();

        // if($year){
        //     $this->purchases = $this->purchases->where(date('Y', strtotime('created_at')), $year);
        //     $this->sales = $this->sales->where(date('Y', strtotime('created_at')), $year);

        if($this->month == 'All'){
            $this->purchases = Purchase::all();
                $this->sales = Sale::all();
        }else{
                $this->purchases = $this->purchases->where('month', date('n', strtotime($this->month)));
                $this->sales = $this->sales->where('Month', $this->month);

                $this->purchases = $this->purchases->get();
                $this->sales = $this->sales->get();
            }
        // }    
    }

    public function render()
    {
        return view('livewire.filter');
    }
}
