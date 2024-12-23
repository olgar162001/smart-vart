<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\HelloUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Collection;

class EmailController extends Controller
{
    public function send(){
        if($this->isOnline()){

            $delay = now()->addMinutes(1);

            $user = User::find(1);
            $user->notify(new HelloUser());
            return redirect('dashboard')->with('success','Email Sent succesfully');

        }else{
            return redirect()->back()->with('error', 'Check your internet connection');
        }
    }

    public function isOnline($site = "https://www.google.com"){
        if(@fopen($site, 'r')){
            return true;
        }else{
            return false;
        }
    }
}
