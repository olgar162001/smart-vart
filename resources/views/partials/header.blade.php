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