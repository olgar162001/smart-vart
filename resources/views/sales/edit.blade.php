@extends('layouts.app')

@section('content')
@include('partials.sidebar')

<div class="container">
    <div class="extra-side-bar">
        <div class="col">
            @livewire('edit-sales', ['sale' => $sale])
        </div>
    </div>
</div>
@endsection
