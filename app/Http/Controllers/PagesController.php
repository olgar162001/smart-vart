<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Package;
use App\Models\Receipt;
use App\Models\Purchase;
use App\Mail\invoiceMail;
use App\Mail\ReceiptMail;
use Illuminate\Http\Request;
use App\Notifications\InvoiceMade;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    
    public function landing(){
        return redirect('/login');
    }

    public function dashboard(){

        $purchases = Purchase::where('month', date('n'))->get();
        $sales = Sale::where('Month', date('F'))->get();

        return view('dashboard')->with([
            'purchases'=> $purchases,
            'sales' => $sales,
        ]);
    }

    public function packages(){
        $packages = Package::all();

        return view('pages.packages')->with('packages', $packages);
    }

    // Update package chosen
    public function update(string $id){
        $user = User::find(auth()->id());
        $package = Package::find($id);

        // Update package to user
        $user->package_id = $id;
        $user->package = $id;
        if($id == 1){
            $user->package_due_date = Carbon::now()->addMonths($package->duration);
        }else if($id == 2){
            $user->package_due_date = Carbon::now()->addMonths($package->duration);
        }else if($id == 3){
            $user->package_due_date = Carbon::now()->addMonths($package->duration);
        }else{
            $user->package_due_date = Carbon::now()->addMonths($package->duration);
        }
        
        $user->company_no = $package->company_no;
        $user->users_no = $package->users_no;
        $user->save();

        $user = User::find(auth()->id());
        $package = Package::find($id);

        // Check if it's a yana client 
        if($user->reg_by_yana == 1){

            return redirect('/verify-payment');
        }else{

            // Create invoice record
            $invoice = new Invoice;
            $invoice->invoice_no = rand(999, 10000);
            $invoice->name = $user->name;
            $invoice->email = $user->email;
            $invoice->package = $package->name;
            $invoice->description = 'Invoice description';
            $invoice->duration = $package->duration;
            $invoice->price = $package->price;
            $invoice->user_id = auth()->id();
            $invoice->package_id = $id;
            $invoice->package = $id;
            $invoice->save();

            return redirect('/invoice/'.$invoice->id.'/mail')->with([
                'user' => $user
            ]);
        }
    }

    public function verify(){
        return view('pages.verify-payment');
    }

    // View payment page
    public function payment_complete(){

        $id = auth()->id();
        $my_invoice = User::find($id)->Invoice()->latest()->first();
        $user = User::find(auth()->id());

        return view('pages.payment')->with([
            'invoice' => $my_invoice,
            'user' => $user,
        ]);
    }

    // Create invoice 
    public function send_invoice($id){
        $user = User::find(1);
        $my_invoice = Invoice::find($id);

        if($this->isOnline()){

            Mail::to($my_invoice->email)->send(new invoiceMail($my_invoice));
            $user->notify(new InvoiceMade());
            return redirect('/payment');

        }else{
            return redirect('/payment')->with('error', 'Check your internet connection');
        }   
    } 

    public function send_receipt($id){
        $user = User::find($id);
        $invoice = User::find($id)->Invoice()->latest()->first();
        $package = Package::find($invoice->package);

        // Create receipt record
        $receipt = new Receipt;
        $receipt->receipt_no = $invoice->invoice_no;
        $receipt->name = $user->name;
        $receipt->email = $user->email;
        $receipt->package = $package->name;
        $receipt->description = 'Payment verified';
        $receipt->duration = $invoice->duration;
        $receipt->amount_paid = $invoice->price;
        $receipt->user_id = $id;
        $receipt->invoice_id = $invoice->id;
        $receipt->save();

        $my_receipt = User::find($id)->Receipt()->latest()->first();

        if($this->isOnline()){

            Mail::to($my_receipt->email)->send(new ReceiptMail($my_receipt));
            return redirect('/admin/users')->with('success', 'Receipt Sent');

        }else{
            return redirect()->back()->with('error', 'Check your internet connection');
        }
    }


// Monthly analysis
    public function analysis(){
        $purchases = Purchase::all();
        $sales = Sale::all();

        return view('month_analysis')->with([
            'purchases'=> $purchases,
            'sales' => $sales,
        ]);
    }

    public function isOnline($site = "https://www.google.com"){
        if(@fopen($site, 'r')){
            return true;
        }else{
            return false;
        }
    }
}
