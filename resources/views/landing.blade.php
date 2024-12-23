@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 78vh;">
        <div class="card border-0 p-3 text-center">
            <img src="{{asset('assets/images/img2.png')}}" style="margin:auto;" width="200" height="130" class="my-2"  alt="">
            <h1 style="font-size: 3.4rem;" class="p-1">Welcome to Smart VAT App</h1>
            <small class="text-secondary" style="font-size: 1.1rem;">Get Your Auto-calculated Value Added Tax</small>
            
            <div class="my-4">
                <a href="/login" class="btn btn-success btn-lg px-4">Login</a>
                <a href="/register" class="btn btn-dark btn-lg px-4">Register</a>
            </div>
        </div>
        
    </div>
@endsection