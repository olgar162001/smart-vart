@extends('layouts.app')

@section('content')
@include('partials.sidebar')

<div class="container">
    <div class="extra-side-bar">
        <div class="col">
            @livewire('edit-inputs', ['purchase' => $purchases])
        </div>
    </div>
</div>
@endsection
