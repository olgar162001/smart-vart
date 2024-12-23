<div class="sidebar">  
    <div class="card bg-dark-subtle">
        <div class="card-header">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><span class="fa fa-globe fa-xl me-2"></span> My Companies</a>
                    <ul class="dropdown-menu">
                        @if (auth()->user()->companies()->count() > 0)
                            @foreach (auth()->user()->companies as $company)
                                <li>
                                    <a class="dropdown-item @if(auth()->user()->current_company_id == $company->id) text-dark fw-bold active @endif" href="/company/change/{{$company->id}}">
                                        @if(auth()->user()->current_company_id == $company->id)  
                                            <span class="position-static shadow-sm me-1 badge rounded-pill bg-success text-success" style="font-size:7px;">1   
                                            </span>
                                        @endif
                                        {{$company->name}}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                        
                    </ul>
                </li>
            </ul>
        </div>

        
            <ul class="list-group">
                <li class="list-group-item list-group-item-action list-group-item-secondary p-2">
                    <a href="/dashboard" class="nav-link p-1"><i class="fa fa-dashboard pe-2"></i>Dashboard</a>
                </li>

                <li class="list-group-item list-group-item-action list-group-item-secondary p-2">
                    <a href="/purchase" class="nav-link p-1"><span class="fa fa-table-list pe-2"></span>Purchases Table</a>
                </li>

                <li class="list-group-item list-group-item-action list-group-item-secondary p-2">
                    <a href="/purchase/create" class="nav-link p-1"><span class="fa fa-shopping-cart pe-2"></span>Fill Purchase</a>
                </li>

                <li class="list-group-item list-group-item-action list-group-item-secondary p-2">
                    <a href="/sales" class="nav-link p-1"><span class="fa fa-table-columns pe-2"></span>Sales Info</a>
                </li>
                
                <li class="list-group-item list-group-item-action list-group-item-secondary p-2">
                    <a href="/sales/create" class="nav-link p-1"><span class="fa fa-dollar-sign pe-2"></span>Input Sales</a>
                </li>

                <li class="list-group-item list-group-item-action list-group-item-secondary p-2">
                    <a href="/monthly-analysis" class="nav-link p-1"><span class="fa fa-line-chart pe-2"></span>Monthly Analysis</a>
                </li>

                <li class="list-group-item list-group-item-action list-group-item-secondary p-2">
                    <a href="/profile" class="nav-link p-1"><span class="fa fa-user pe-2"></span>Profile</a>
                </li>
                
                <li class="list-group-item list-group-item-action list-group-item-secondary p-2">
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="nav-link p-1"><span class="fa fa-sign-out pe-2"></span>Logout</a>
                </li>
            </ul>
    </div>
</div>