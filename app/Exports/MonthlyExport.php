<?php

namespace App\Exports;

use App\Models\Sale;
use App\Models\Purchase;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MonthlyExport implements FromView, ShouldAutoSize
{
    /**
    * @return View
    */

    public $month;

    public function __construct($month){
        $this->month = $month;
    }

    public function view(): View
        {

            $month = $this->month['month'];
            // echo '<pre>';
            // var_dump(date('n', strtotime($month['month'])));
            // echo '</pre>';

            // dd($this->month['month']);

            return view('exports.month', [
                // 'purchases' => Purchase::where('month', date('n'))->get(),
                'purchases' => Purchase::where('month', date('n', strtotime($month)))->get(),
                'sales' => Sale::where('Month', $month)->get()
            ]);               
        }

}
