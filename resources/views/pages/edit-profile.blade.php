@extends('layouts.app')
@include('partials.sidebar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="mb-2">
                <a href="/profile" class="btn btn-dark bg-gradient"><i class="fa fa-arrow-left mx-1"></i>Back</a>
            </div>

            {{-- Card Section --}}
            <div class="card">
                <div class="py-3 text-center"><h2>Edit Profile</h2></div>

                <div class="card-body shadow py-5">
                    <form action="/profile/{{$user->id}}" method="POST" enctype="multipart/form-data">
                        {{method_field('PUT')}}
                        {{ csrf_field() }}
                        
                        <div class="row mb-4">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Username</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Email</label>

                            <div class="col-md-6">
                                <input id="address" type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="" required autocomplete="email">
                            </div>
                        </div>

                        {{-- Telephone input --}}
                        <div class="row mb-4">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="tel" accept="[0-9]" class="form-control" name="phone" value="{{$user->phone}}" required autocomplete="phone">
                            </div>
                        </div>

                        {{-- Profile picture --}}
                        <div class="row mb-4">
                            <label for="profile_pic" class="col-md-4 col-form-label text-md-end">Profile Photo</label>

                            <div class="col-md-6">
                                <input id="profile_pic" type="file" class="form-control" name="profile_pic" value="{{$user->profile_pic}}">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 form-group offset-md-4">
                                <input type="submit" value="Edit" class="btn btn-success bg-gradient form-control">        
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
