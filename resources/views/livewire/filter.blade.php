<div class="container">
    <div class="my-3">
        <div class="d-flex justify-content-between">
            <form action="/monthly-analysis/export" method="post" class="d-flex">
                {{csrf_field()}}
                <div class="d-flex gap-4 row">
                         {{-- Filter By Month --}}
                    <div class="col-auto">
                        <label for="Month" class="">Month</label>
                        <select class="form-select text-bg-dark" wire:model="month" value="{{$month}}" wire:change="filter" name="month" id="">
                            <option value="All">All</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="Decemeber">Decemeber</option>
                        </select>
                         </div>
                    
                    {{-- Filter by Year --}}
                    <div class="col-auto">
                        <label class="" for="Year">Year</label>
                        <select class="form-select text-bg-dark" name="" id="">
                            <option value="2023">2023</option>
                        </select>
                    </div>   
                </div>                                    
            

            <div class="mt-3 month-export">
                <div class="dropdown">
                    <a class="btn btn-dark bg-gradient dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-file-export me-1"></i>Export Month Report</a>
                    <ul class="dropdown-menu">
                        <li><input type="submit" class="dropdown-item" value="Download"></li>
                      {{-- <li><a class="dropdown-item" href="/monthly-analysis/export"><i class="fa fa-download me-2"></i>Download</a></li> --}}
                      {{-- <li><a class="dropdown-item" href="#"><i class="fa fa-share-alt me-2"></i>Share via Email</a></li> --}}
                    </ul>
                </div>
            </div>
        </form>
        </div>

        {{-- Purchases Details --}}
        <div class="mb-5">
            <h3 class="text-dark text-center ">Purchase Details</h3>
            <hr style="margin: auto; width: 8%;">
            {{-- Purchases table details --}}
            <div class="table-responsive-md container-fluid">
                <table class="table table-rounded table-secondary table-striped table-hover my-2 table-width">
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
                                    <td wire:model = "purchases">{{$purchase->created_at}}</td>
                                    <td wire:model = "purchases">{{$purchase->supplier_name}}</td>
                                    <td wire:model = "purchases">{{$purchase->goods_description}}</td>
                                    <td wire:model = "purchases">{{$purchase->url}}</td>
                                    <td wire:model = "purchases">{{number_format($purchase->amount_inclusive,2)}}</td>
                                    <td wire:model = "purchases">{{number_format($purchase->amount_exclusive,2)}}</td>
                                    <td wire:model = "purchases">{{number_format($purchase->vat,2)}}</td>
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
                                <th></th>
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

        {{-- Sales Details --}}
        <div class="my-5">
            <h3 class="text-dark text-center">Sales Details</h3>
            <hr style="margin: auto; width: 8%;">
            {{-- Sales table details --}}
            <div class="table-responsive-md container-fluid">
                <table class="table table-rounded table-secondary table-striped table-hover my-2 table-width">
                    <tr>
                        <th>s/n</th>
                        <th>Total Inclusive Sales</th>
                        <th>Total Exclusive Sales</th>
                        <th>Total Sales VAT </th>
                        <th>Month</th>
                        @if (auth()->user()->Role == 1)
                            <th>Action</th>
                        @endif
                    </tr>

                    <tbody class="table-group-divider">
                        @if (count($sales) > 0)
                            @foreach ($sales as $i => $sale)
                                <tr>
                                    <td>{{$i + 1}}</td>
                                    <td>{{number_format($sale->total_inclusive_sales,2)}}</td>
                                    <td>{{number_format($sale->total_exclusive_sales,2)}}</td>
                                    <td>{{number_format($sale->total_sales_vat,2)}}</td>
                                    <td>{{$sale->Month}}</td>
                                    @if (auth()->user()->Role == 1)
                                        <td class="d-flex">
                                            <a href="/sales/{{$sale->id}}/edit" class="text-success"><span class="fas fa-edit"></span></a>
                                            <form action="sales/{{$sale->id}}" method="POST">
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
                                <td>No Sales Records</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{date('F')}}</td>
                                @if (auth()->user()->Role == 1)
                                    <td></td>
                                @endif
                            </tr>
                        @endif                
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- VAT Difference Details --}}
        <div class="my-5">
            <h3 class="text-dark text-center my-2">VAT Difference Details</h3>
            <hr style="margin: auto; width: 8%;">
            {{-- VAT Difference table --}}
            <div class="table-responsive-md container-fluid">
                <table class="table table-rounded table-secondary table-striped table-hover my-2 table-width">
                    <tr>
                        <th>s/n</th>
                        <th>Total Sales VAT</th>
                        <th>Total Purchases VAT</th>
                        <th>VAT Difference</th>
                        <th>Month</th>
                    </tr>

                    <tbody class="table-group-divider">
                            <tr>
                                <td></td>
                                <td>{{number_format($sales->sum('total_sales_vat'),2)}}</td>
                                <td>{{number_format($purchases->sum('vat'),2)}}</td>
                                <td>{{number_format((($sales->sum('total_sales_vat')) - ($purchases->sum('vat'))),2)}}</td>
                                <td>{{$month}}</td>
                            </tr>        
                    </tbody>
                </table>
            </div>
        </div>    
    </div>
</div>
