@extends('layouts.app')
@include('partials.sidebar')

@section('content')
<div class="container profile-card">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="container">
                <h1 class="text-center pb-4">Welcome {{$user->name}}</h1>
            </div>
            <div class="card">
                <div class="py-3 text-center"><h2>Register Company</h2></div>

                <div class="card-body shadow py-5">
                    <form method="POST" action="/company">
                        @csrf
                        <div class="row mb-4">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Company Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="(Optional)" autocomplete="address">
                            </div>
                        </div>

                        {{-- Company section --}}
                        <div class="row mb-4">
                            <label for="company" class="col-md-4 col-form-label text-md-end">Region</label>

                            <div class="col-md-6">
                                <select name="region" class="form-select" value="{{ old('region') }}" id="region">
                                    @foreach ($regions as $region)
                                        <option value="{{$region->name}}">{{$region->name}}</option>
                                    @endforeach    
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 form-group offset-md-4">
                                <button type="submit" class="btn btn-success bg-gradient form-control">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
