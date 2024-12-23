<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SalesInputs extends Component
{
    public $totalInclusive;
    public $totalExclusive;
    public $totalVat;

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
        return view('livewire.sales-inputs');
    }
}
