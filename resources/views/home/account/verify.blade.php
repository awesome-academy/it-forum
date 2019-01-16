@extends('home.master')

@section('title', __('page.account.titleLogin'))

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-center text-white">
                    <h1 class="mb-0">
                        {{ __('email.title') }}
                    </h1>
                </div>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('email.resendSuccess') }}
                        </div>
                    @endif
                    {{ __('email.notVerifyYet') }}
                    {{ __('email.notReceive') }}, <a href="{{ route('home.email.resend', ['id' => $user->id]) }}">{{ __('email.resend') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
