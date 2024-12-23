<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditInputs extends Component
{
    public $purchase;
    public $url;
    public $inclusiveInput;
    public $exclusiveInput;
    public $vatInput;
    public $supplierName;
    public $goods;

    public function mount($purchase)
    {
        $this->supplierName = $purchase->supplier_name;
        $this->url = $purchase->url;
        $this->inclusiveInput = $purchase->amount_inclusive;
        $this->exclusiveInput = $purchase->amount_exclusive;
        $this->vatInput = $purchase->vat;
        $this->goods = $purchase->goods_description;
    }
    
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
        return view('livewire.edit-inputs');
    }
}
