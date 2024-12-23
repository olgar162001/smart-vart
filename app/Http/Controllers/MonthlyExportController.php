<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Exports\MonthlyExport;
use App\Exports\PurchasesExport;
use Maatwebsite\Excel\Facades\Excel;

class MonthlyExportController extends Controller
{
    public function export(Request $request){
        $month = $request->input('month');

        if(Purchase::where('month', date('n', strtotime($month)))->count() > 0){
            if($month == 'All') {
                return redirect('/monthly-analysis')->with('error','Please Choose Month to Export Report');
            }else{
                return Excel::download(new MonthlyExport(['month' => $month]), 'Monthly VAT Report.xlsx');
            }
        }else{
            return redirect('/monthly-analysis')->with('error','You Have No Month Records to Export');
        }
    }
}
