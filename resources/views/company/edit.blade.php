@extends('layouts.app')
@include('partials.sidebar')

@section('content')
<div class="container profile-card">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="mb-2">
                <a href="/profile" class="btn btn-dark bg-gradient"><i class="fa fa-arrow-left mx-1"></i>Back</a>
            </div>

            {{-- Card Section --}}
            <div class="card">
                <div class="py-3 text-center"><h2>Edit Company</h2></div>

                <div class="card-body shadow py-5">
                    <form action="/company/{{$company->id}}" method="POST" enctype="multipart/form-data">
                        {{method_field('PUT')}}
                        {{ csrf_field() }}
                        
                        <div class="row mb-4">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Company Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$company->name}}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{$company->address}}" placeholder="(Optional)" autocomplete="address">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="region" class="col-md-4 col-form-label text-md-end">Region</label>

                            <div class="col-md-6">
                                <select name="region" class="form-select" value="{{ old('region') }}" id="region">
                                    @foreach ($regions as $region)
                                        <option value="{{$region->name}}">{{$region->name}}</option>
                                    @endforeach    
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="company_pic" class="col-md-4 col-form-label text-md-end">Company Logo</label>
    
                            <div class="col-md-6">
                                <input id="company_pic" type="file" class="form-control" name="company_pic" value="{{$company->company_pic}}">
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
