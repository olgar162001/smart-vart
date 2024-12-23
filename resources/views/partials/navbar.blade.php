<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Livewire --}}
    @livewireStyles

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    {{-- <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@600;700;800&display=swap" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{asset('pos.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/font-awesome/css/all.css')}}">

    {{-- Stylesheet --}}
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dark bg-gradient shadow sticky-top">
            <div class="container">
                <a class="navbar-brand text-light" href="{{ url('/') }}">
                    <img src="{{asset('pos.png')}}" width="40" height="26" alt=""> {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" style="color:#fff;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon">
                        <i class="fas fa-bars" style="color:#fff; font-size:24px;"></i>
                    </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @guest

                    @else
                    <ul class="navbar-nav me-auto mx-5">
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link text-light d-md-none">Dashboard</a>
                        </li>

                        <li class="nav-item dropdown d-md-none">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Purchases
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" data-bs-theme="dark" aria-labelledby="navbarDropdown">
                                <a href="/purchase" class="dropdown-item">Purchases Table</a>
                                <a href="/purchase/create" class="dropdown-item">Add Purchase</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown d-md-none">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Sales
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" data-bs-theme="dark" aria-labelledby="navbarDropdown">
                                <a href="/sales" class="dropdown-item">Sales Info</a>
                                <a href="/sales/create" class="dropdown-item">Add Total Sales</a>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a href="/monthly-analysis" class="nav-link text-light d-md-none">Monthly Analysis</a>
                        </li>
                    </ul>
                    @endguest
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                        {{-- Companies dropdown --}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="fa fa-globe fa-xl me-2"></span> My Companies
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" data-bs-theme="dark" aria-labelledby="navbarDropdown">
                                {{-- @if (auth()->user()->company()->count() > 0)
                                    @foreach (auth()->user()->company as $company)
                                        <a href="/company/change/{{$company->id}}" class="dropdown-item @if(auth()->user()->current_company_id == $company->id) fw-bold active @endif">
                                            @if(auth()->user()->current_company_id == $company->id) 
                                                <span class="position-static shadow-sm me-1 badge rounded-pill bg-success text-success" style="font-size:7px;">1   
                                                </span>
                                            @endif
                                             {{$company->name}}
                                        </a>
                                    @endforeach
                                @endif --}}
                                @if (auth()->user()->companies()->count() > 0)
                                    @foreach (auth()->user()->companies as $company)
                                        <a href="/company/change/{{$company->id}}" class="dropdown-item @if(auth()->user()->current_company_id == $company->id) fw-bold active @endif">
                                            @if(auth()->user()->current_company_id == $company->id) 
                                                <span class="position-static shadow-sm me-1 badge rounded-pill bg-success text-success" style="font-size:7px;">1   
                                                </span>
                                            @endif
                                             {{$company->name}}
                                        </a>
                                    @endforeach
                                @endif
                                
                                
                            </div>
                        </li>

                        {{-- User Profile dropdown --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-user-circle fa-xl pe-2"></i>{{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" data-bs-theme="dark" aria-labelledby="navbarDropdown">
                                    <a href="/profile" class="dropdown-item">Profile - <em>@if (auth()->user()->Role == 1) Admin @else Auditor @endif</em></a>
                                    @if(count(auth()->user()->company) < auth()->user()->company_no)
                                        {{-- <a href="/company/create" class="dropdown-item">Create Company</a> --}}
                                    @endif

                                    @if(auth()->user()->email == 'praiselemmah@gmail.com' || auth()->user()->email == 'info@yana.africa')
                                        <a href="/admin" class="dropdown-item">Admin Panel</a>
                                    @endif
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>