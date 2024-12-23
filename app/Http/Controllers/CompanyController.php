<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckCompanyNoAllowed;
use App\Models\User;
use App\Models\Region;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware([CheckCompanyNoAllowed::class])->except(['edit', 'update', 'changeCompany']);
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = auth()->id();
        $user = User::find($id);
        $regions = Region::all();
        
        return view('company.create')->with([
            'user'=> $user,
            'regions' => $regions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(['name' => 'required',]);

        $company = new Company;
        $company->name = $request->input('name');
        $company->address = $request->input('address');
        $company->region = $request->input('region');
        $company->user_id = auth()->id();
        $company->save();
        
        $company->User()->attach([auth()->id() => [
            'company_id' => $company->id,
        ]]);
 
        return redirect('dashboard')->with('success','Company Created');
    }

    public function show(string $id)
    {
        $user = User::find($id);
        return view('dashboard')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::find($id);
        $regions = Region::all();
        
        return view('company.edit')->with([
            'company' =>$company,
            'regions' => $regions
    ]);
    }

    public function update(Request $request, string $id)
    {
        $company = Company::find($id);
        $company->name = $request->input('name');
        $company->address = $request->input('address');
        $company->region = $request->input('region');
        if($request->hasFile('company_pic')) {
            $company->company_pic = $request->file('company_pic')->store('company_pics', 'public');
        }
        $company->save();
        
        return redirect('/profile')->with('success','Company Edited');
    }

    public function destroy(string $id)
    {
        //
    }

    public function changeCompany($companyId){
        $company = auth()->user()->companies()->findOrFail($companyId);
        auth()->user()->update(['current_company_id' => $companyId]);

        return redirect('/dashboard');
    }
}
