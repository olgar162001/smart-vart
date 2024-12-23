@extends('layouts.app')

@section('content')
    @include('partials.sidebar')

    <div class="main-bar">
        <div class="container">
            <h1 class="text-center text-dark">Monthly Analysis</h1>
            <hr style="margin: auto; width: 8%;">
            <div class="my-3">
                @livewire('filter', [
                    'purchases' => $purchases,
                    'sales' => $sales
                ])       
            </div>
        </div>
    </div>
@endsection