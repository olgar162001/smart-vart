<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CalculateInputs extends Component
{
    public $inclusiveInput;
    public $exclusiveInput;
    public $vatInput;

    public function update(){
        if($this->inclusiveInput !== ''){
            $this->exclusiveInput = round(($this->inclusiveInput * 100/118), 2);
            $this->vatInput = round($this->exclusiveInput * 0.18, 2);
        }else{
            $this->exclusiveInput = '';
            $this->vatInput = '';
        }
        
        // $this->input = $this->inclusiveInput;
    }
    public function render()
    {
        return view('livewire.calculate-inputs');
    }
}
