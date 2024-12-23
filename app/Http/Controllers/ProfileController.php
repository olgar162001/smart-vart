<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index()
    {
        $id = auth()->id();
        $company_id = Auth::user()->current_company_id;

        $user = User::find($id);
        $company = Company::find($company_id);

        return view('pages.profile')->with([
            'user' => $user,
            'company' => $company,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        return view('pages.edit-profile')->with('user', $user);
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        if($request->hasFile('profile_pic')) {
            $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 'public');
        }
        
        $user->save();

        return redirect('/profile')->with('success','Profile Edited!');
    }

    public function destroy(string $id)
    {
        //
    }

    public function change_status (string $id){
        $user = User::find($id);
        if($user->status = 0){
            $user->status = 1;
            $user->save();
        }else{
            $user->status = 0;
            $user->save();
        }   
        return redirect('/admin/users');
    }

    public function verify_user_email($id){
        $user = User::find($id);
        $user->email_verified_at = NOW();
        $user->save();

        return redirect('/admin/users');
    }
}
