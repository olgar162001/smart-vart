<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\Total;
use App\Models\Purchase;
use Illuminate\Http\Request;

use \Illuminate\Database\Eloquent\Relations\HasMany;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = auth()->id();
        $sale = User::find($id)->Sale;
        return view('sales.index',)->with('sales', $sale);
    }

    public function create()
    {
        return view('sales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'total_inclusive_sales'=> 'required',
            // 'Month'=> 'unique:sales',
        ]);
        $total_vat = new Total;
        $sale = new Sale;
        $purchase = Purchase::all();

            $sale->total_inclusive_sales = $request->input('total_inclusive_sales');
            $sale->total_exclusive_sales = $request->input('total_exclusive_sales');
            $sale->total_sales_vat = $request->input('total_sales_vat');
            $sale->Month = $request->input('Month');
            $sale->month_id = date('n');
            $sale->user_id = auth()->id();
            $sale->save();
                
            return redirect('/sales')->with('success','Total Sales Added!');        
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $sale = Sale::find($id);
        return view('sales.edit')->with('sale', $sale);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'total_inclusive_sales'=> 'required',
        ]);

        $sale = Sale::find($id);
        $sale->total_inclusive_sales = $request->input('total_inclusive_sales');
        $sale->total_exclusive_sales = $request->input('total_exclusive_sales');
        $sale->total_sales_vat = $request->input('total_sales_vat');
        // $sale->month_id = date('n');
        $sale->Month = $request->input('Month');
        $sale->save();
                
        return redirect('/sales')->with('success','Total Sales Edited!');
        
    }

    public function destroy(string $id)
    {
        $sale = Sale::find($id);
        $sale->delete();
           
        return redirect('/sales')->with('success', 'Total Sales Deleted');
    }
}
