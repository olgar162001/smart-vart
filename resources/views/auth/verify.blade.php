@extends('layouts.auth_app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="py-2">
                    <h2 class="card-title text-center">{{ __('Verify Your Email Address') }}</h2>
                </div>
                
                <div class="card-body shadow py-4">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-dark bg-gradient  m-2 align-baseline">{{ __('Click Here to Request Another') }}</button>
                    </form>

                    <a href="/dashboard" class="link-body-emphasis">Go To Dashboard<i class="fa fa-arrow-right mx-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
