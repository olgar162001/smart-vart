@extends('layouts.auth_app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="py-3 text-center"><h1>{{ __('Register') }}</h1></div>

                <div class="card-body shadow py-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-4">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Phone number section --}}
                        <div class="row mb-4">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="tel" title="Please Enter your Phone Number that is available" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Company section --}}
                        <div class="row mb-4">
                            <label for="company" class="col-md-4 col-form-label text-md-end">{{ __('Company Name') }}</label>

                            <div class="col-md-6">
                                <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company') }}" required autocomplete="company">
                            </div>
                        </div>

                        {{-- Region section --}}
                        <div class="row mb-4">
                            <label for="region" class="col-md-4 col-form-label text-md-end">{{ __('Region') }}</label>
                            
                            <div class="col-md-6">
                                <select name="region" class="form-select" value="{{ old('region') }}" id="region">
                                    @foreach ($regions as $region)
                                        <option value="{{$region->name}}">{{$region->name}}</option>
                                    @endforeach    
                                </select>
                                {{-- <input id="region" type="text" class="form-control @error('region') is-invalid @enderror" name="region" value="{{ old('region') }}" required autocomplete="region"> --}}
                            </div>
                        </div>

                        {{-- Password section --}}

                        <div class="row mb-4">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 form-group offset-md-4">
                                <button type="submit" class="btn btn-success bg-gradient form-control">
                                    {{ __('Register') }}
                                </button>
                                <div class="mt-3">
                                    <a href="/login" class="link-body-emphasis m-3"><i class="fa fa-arrow-left mx-2"></i>Back to Login</a>
                                    @if (url()->full() == 'https://vatapp.site/yana/register')
                                        <span class="mx-3 text-secondary">@YanaCorp</span>
                                    @endif
                                </div>
                                
                            </div>   
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
