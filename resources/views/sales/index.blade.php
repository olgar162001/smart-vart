@extends('layouts.app')

@section('content')
@include('partials.sidebar')

<div class="main-bar">
    <div class="container">
        <h1 class="text-dark text-center ">Total Sales Info</h1>
        <hr style="margin: auto; width: 8%;" class="pb-3">

        <div class="container d-flex justify-content-between">
            <a href="/sales/create" class="btn btn-dark bg-gradient mb-1"><i class="fa fa-plus"></i> Add Sales</a>
            <div class="dropdown">
                <a class="btn btn-dark bg-gradient mb-1 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-file-export me-1"></i>Export Report</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/purchase/export"><i class="fa fa-download me-2"></i>Download</a></li>
                  {{-- <li><a class="dropdown-item" href="#"><i class="fa fa-share-alt me-2"></i>Share via Email</a></li> --}}
                </ul>
            </div>
        </div>
        
        <div class="container d-flex flex-wrap">
            
            {{-- Sales Card layout --}}
            @if(count($sales) > 0)
                @foreach ($sales as $sale)
                    {{-- Sales Card --}}
                        <div class="card py-2 m-2 shadow sales-card-width">
                            <div class="card-body">
                                <div class="top-sub-container d-flex justify-content-between">
                                    <div class="amount">
                                        <p class="card-text">Total Sales VAT</p>
                                        <h1 class="card-title"><span class="fs-2 fw-bold">TZS</span> {{number_format($sale->total_sales_vat, 2)}}</h1>
                                    </div>
                                    
                                    <div class="">   
                                        <h5>Month</h5>
                                        <p class="card-text">{{$sale->Month}}</p>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap p-2">
                                    {{-- Total Inclusive sales card --}}
                                    <div class="card shadow total-sales-card mx-1">
                                        <div class="card-body">
                                            <p class="card-text">Total Inclusive Sales</p>
                                            <h4 class="card-title">TZS {{number_format($sale->total_inclusive_sales, 2)}}</h4>
                                        </div>
                                    </div>

                                    {{-- Total exclusive sales card--}}
                                    <div class="card shadow total-sales-card mx-1">
                                        <div class="card-body">
                                            <p class="card-text">Total Exclusive Sales</p>
                                            <h4 class="card-title">TZS {{number_format($sale->total_exclusive_sales, 2)}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                @if (auth()->user()->Role == 1)
                                    <a href="/sales/{{$sale->id}}/edit" class="btn btn-dark bg-gradient mx-2">Edit</a>
                                    <form action="sales/{{$sale->id}}" method="POST">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger bg-gradient">Delete</button>
                                    </form>     
                                @endif
                            </div>
                        </div>  
                @endforeach
            @else
            <div class="container p-2">
                <h3>No Sales Records Inserted</h3>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection