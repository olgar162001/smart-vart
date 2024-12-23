<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $purchases = Purchase::where('month', date('n'))->get();
        return view('purchase.purchase')->with('purchases', $purchases);
    }

    public function create()
    {
        // dd(auth()->user()->Role);
        return view('purchase.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_name'=> 'required',
            'amount_inclusive'=> 'required',
        ]);

        $purchase = new Purchase;
        $purchase->supplier_name = $request->input('supplier_name');
        $purchase->goods_description = $request->input('goods');
        $purchase->amount_inclusive = $request->input('amount_inclusive');
        $purchase->amount_exclusive = $request->input('amount_exclusive');
        $purchase->vat = $request->input('vat');
        $purchase->company_id = auth()->id();
        $purchase->month = date('n');
        $purchase->url = $request->input('url');
        $purchase->save();

        return redirect('/purchase')->with('success','Purchase Added!'); 
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $purchase = Purchase::find($id);

        return view('purchase.edit')->with('purchases', $purchase);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'supplier_name'=> 'required',
            'amount_inclusive'=> 'required',
        ]);

        $purchase = Purchase::find($id);
        $purchase->supplier_name = $request->input('supplier_name');
        $purchase->goods_description = $request->input('goods');
        $purchase->amount_inclusive = $request->input('amount_inclusive');
        $purchase->amount_exclusive = $request->input('amount_exclusive');
        $purchase->vat = $request->input('vat');
        $purchase->month = date('n');
        $purchase->url = $request->input('url');
        $purchase->save();
        
        return redirect('/purchase')->with('success','Purchase Edited!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchase = Purchase::find($id);
        $purchase->delete();

        return redirect('/purchase')->with('success','Purchase Deleted!');
    }
}
