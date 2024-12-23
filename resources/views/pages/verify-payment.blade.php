@extends('layouts.auth_app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="py-2">
                    <h2 class="card-title text-center">{{ __('Account is being activated.') }}</h2>
                </div>
                
                <div class="card-body shadow py-4">

                    <p>{{ __('Please wait while your account is being activated..') }}</p>
                    <p>{{ __('If your account is already activated, click the button below') }},</p>
                        <a href="/dashboard" class="btn btn-dark bg-gradient m-2 align-baseline">{{ __('Go to dashboard') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
