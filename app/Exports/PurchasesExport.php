<?php

namespace App\Exports;

use App\Models\Sale;
use App\Models\Purchase;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PurchasesExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
        public function view(): View
        {
                return view('exports.purchases', [
                    'purchases' => Purchase::where('month', date('n'))->get(),
                    'sales' => Sale::where('Month', date('F'))->get()
                ]);               
        }
}
