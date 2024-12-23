@extends('layouts.app')

@section('content')
@include('partials.sidebar')

<div class="main-bar">
    <div class="container">
        <h1 class="text-dark text-center ">Purchase Details</h1>
        <hr style="margin: auto; width: 8%;">
        <div class="container">
            <div class="container d-flex justify-content-between">
                <a href="/purchase/create" class="btn btn-dark bg-gradient mb-3"><i class="fa fa-plus me-1"></i> Add Purchase</a>
                <div class="dropdown">
                    <a class="btn btn-dark bg-gradient mb-3 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-file-export me-1"></i>Export Report</a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="/purchase/export"><i class="fa fa-download me-2"></i>Download</a></li>
                      {{-- <li><a class="dropdown-item" href="#"><i class="fa fa-share-alt me-2"></i>Share via Email</a></li> --}}
                    </ul>
                </div>
            </div>
            
            <div class="table-responsive-md container-fluid">
                <table class="table table-rounded table-secondary table-striped table-hover">
                    <tr>
                        <th>s/n</th>
                        <th>Date</th>
                        <th>Supplier Name</th>
                        <th>Goods Description</th>
                        <th>URL</th>
                        <th>Amount Inlcusive <small>(Tshs)</small></th>
                        <th>Amount Exclusive <small>(Tshs)</small></th>
                        <th>VAT <small>(Tshs)</small></th>
                        @if (auth()->user()->Role == 1)
                            <th>Action</th>
                        @endif
                    </tr>

                    <tbody class="table-group-divider">
                        @if(count($purchases) > 0)
                            @foreach ($purchases as $i => $purchase)
                                <tr>
                                    <td>{{$i + 1}}</td>
                                    <td>{{$purchase->created_at}}</td>
                                    <td>{{$purchase->supplier_name}}</td>
                                    <td>{{$purchase->goods_description}}</td>
                                    <td>{{$purchase->url}}</td>
                                    <td>{{number_format($purchase->amount_inclusive,2)}}</td>
                                    <td>{{number_format($purchase->amount_exclusive,2)}}</td>
                                    <td>{{number_format($purchase->vat,2)}}</td>
                                    @if (auth()->user()->Role == 1)
                                        <td class="d-flex">
                                            <a href="/purchase/{{$purchase->id}}/edit" class="text-success"><span class="fas fa-edit"></span></a>
                                            <form action="/purchase/{{$purchase->id}}" method="POST">
                                                {{ csrf_field() }}
                                                {{method_field('DELETE')}}
                                                <button type="submit" value="" class="fas fa-trash text-danger border-0 bg-transparent"></button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td></td>
                                <td>No Purchase Records Inserted</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @if (auth()->user()->Role == 1)
                                    <td></td>
                                @endif
                            </tr>    
                        @endif
                    </tbody>
                    <tfoot class="table-group-divider table-dark">
                        
                        @if (count($purchases) > 0)
                            <tr>
                                <td></td>
                                <th>Total Purchases</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>{{number_format($purchases->sum('amount_inclusive'),2)}}</th>
                                <th>{{number_format($purchases->sum('amount_exclusive'),2)}}</th>
                                <th>{{number_format($purchases->sum('vat'),2)}}</th>
                                @if (auth()->user()->Role == 1)
                                    <td></td>
                                @endif
                            </tr>
                        @else
                            <tr>
                                <td></td>
                                <th>Total Purchase</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @if (auth()->user()->Role == 1)
                                    <td></td>
                                @endif
                            </tr>
                        @endif   
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection