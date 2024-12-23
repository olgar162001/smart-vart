@extends('layouts.app')

@section('content')
    @include('partials.sidebar')

    <div class="main-bar">
        <div class="container">
            <h1 class="text-center text-dark">Dashboard</h1>
            <hr style="margin: auto; width: 8%;">

            <div class="dropdown mx-3">
                <a class="btn btn-dark bg-gradient dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-file-export me-1"></i>Export Report</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/purchase/export"><i class="fa fa-download me-2"></i>Download</a></li>
                  {{-- <li><a class="dropdown-item" href="#"><i class="fa fa-share-alt me-2"></i>Share via Email</a></li> --}}
                </ul>
            </div>

            <div class="container mx-2 d-flex flex-wrap my-2">
                {{-- Card section --}}
                <div class="card card-width border-0 m-2 bg-danger-subtle shadow">
                    <div class="card-header">
                        <h2>Total Purchases VAT</h2>
                    </div>
                    <div class="card-body py-4 d-flex justify-content-between">
                        <div>
                            <p class="card-text">Total VAT</p>
                            @if (count($purchases) > 0)
                                <h3 class="card-text">TZS {{number_format($purchases->sum('vat') ,2)}}</h3>  
                            @else 
                                <h3 class="card-text">N/A</h3>
                            @endif
                            
                        </div>
                        <p class="bg-light rounded-5 d-flex justify-content-center align-items-center"><span class="fa fa-shopping-cart p-3 text-dark fa-2x"></span></p>
                    </div>

                    <div class="card-footer">
                        <a href="/purchase" class="btn btn-dark border-0 bg-gradient">More Info <span class="fa fa-arrow-right"></span></a>
                    </div>
                </div>
                {{-- End card section --}}

                {{-- Card section --}}
                <div class="card card-width m-2 border-0 bg-success-subtle shadow">
                    <div class="card-header">
                        <h2>Total Sales VAT</h2>
                    </div>
                    <div class="card-body py-4 d-flex justify-content-between">
                        <div>
                            <p class="card-text">Total VAT</p>
                            @if (count($sales) > 0)
                                <h3 class="card-text">TZS {{number_format($sales->sum('total_sales_vat') ,2)}}</h3>
                            @else
                                <h3 class="card-text">N/A</h3>
                            @endif
                            
                        </div>
                        <p class="bg-light rounded-5 d-flex justify-content-center align-items-center"><span class="fa fa-wallet p-3 text-dark fa-2x"></span></p>
                    </div>

                    <div class="card-footer">
                        <a href="/sales" class="btn btn-dark border-0 bg-gradient">More Info <span class="fa fa-arrow-right"></span></a>
                    </div>
                </div>
                {{-- End card section --}}
                
                {{-- Card section --}}
                <div class="card m-2 remarks-card-width border-0 bg-primary-subtle shadow">
                    <div class="card-header d-flex align-items-center justify-content-between"> 
                        <h2>Remarks</h2>
                        <h5>Month: {{date('F')}}</h5>
                    </div>

                    <div class="card-body py-4 d-flex justify-content-between">
                        <div>
                            <p class="card-text">VAT Status</p>
                            @if (count($sales) > 0 && count($purchases) > 0)
                                @if ((($sales->sum('total_sales_vat')) - ($purchases->sum('vat'))) > 0)
                                    <h1 class="card-text">Pay:</h1><h4 class="display-inline">TZS {{number_format((($sales->sum('total_sales_vat')) - ($purchases->sum('vat'))) ,2)}}</h4> 
                                @else
                                    <h1 class="card-text">Refund:</h1> <h4>TZS {{number_format((($sales->sum('total_sales_vat')) - ($purchases->sum('vat'))) ,2)}}</h4>   
                                @endif
                            @else
                                <h3 class="card-text">N/A</h3>
                            @endif

                        </div>
                        <p class="bg-light rounded-5 d-flex justify-content-center align-items-center"><span class="fa fa-money-check p-3 text-dark fa-2x"></span></p>
                    </div>

                </div>
                {{-- End card section --}}

            </div>
        </div>
    </div>
@endsection