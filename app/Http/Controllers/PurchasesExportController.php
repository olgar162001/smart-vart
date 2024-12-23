<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Exports\PurchasesExport;
use Maatwebsite\Excel\Facades\Excel;

class PurchasesExportController extends Controller
{
    public function export(){
        if(Purchase::all()->count() > 0){
            return Excel::download(new PurchasesExport, 'VAT Report.xlsx');
        }else{
            return redirect('/purchase')->with('error','You Have No Records to Export');
        }
    }
}
