<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditSales extends Component
{
    public $sale;
    public $totalInclusive;
    public $totalExclusive;
    public $totalVat;

    public function mount($sale){
        $this->totalInclusive = $sale->total_inclusive_sales;
        $this->totalExclusive = $sale->total_exclusive_sales;
        $this->totalVat = $sale->total_sales_vat;
    }

    public function update(){
        if($this->totalInclusive !== ''){
            $this->totalExclusive = round(($this->totalInclusive * 100/118), 2);
            $this->totalVat = round($this->totalExclusive * 0.18, 2);
        }else{
            $this->totalExclusive = '';
            $this->totalVat = '';
        }
    }
    public function render()
    {
        return view('livewire.edit-sales');
    }
}
