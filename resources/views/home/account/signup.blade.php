@extends('home.master')

@section('title', __('page.account.titleSignup'))

@section('css')
@endsection
@section('content')
<div id="login-page" class="py32">
    <div class="fs-title mx-auto mb24">
        {{ __('page.account.titleSignup') }}     
    </div>
    <div id="formContainer" class="bar-md">
        <div id="openid-buttons" class="">
            <div class="major-provider google-login">
                <svg aria-hidden="true" class="svg-icon native iconGoogle scale18" viewBox="0 0 18 18">
                    <g>
                        <path d="M16.51 8H8.98v3h4.3c-.18 1-.74 1.48-1.6 2.04v2.01h2.6a7.8 7.8 0 0 0 2.38-5.88c0-.57-.05-.66-.15-1.18z" fill="#4285F4"></path>
                        <path d="M8.98 17c2.16 0 3.97-.72 5.3-1.94l-2.6-2a4.8 4.8 0 0 1-7.18-2.54H1.83v2.07A8 8 0 0 0 8.98 17z" fill="#34A853"></path>
                        <path d="M4.5 10.52a4.8 4.8 0 0 1 0-3.04V5.41H1.83a8 8 0 0 0 0 7.18l2.67-2.07z" fill="#FBBC05"></path>
                        <path d="M8.98 4.18c1.17 0 2.23.4 3.06 1.2l2.3-2.3A8 8 0 0 0 1.83 5.4L4.5 7.49a4.77 4.77 0 0 1 4.48-3.3z" fill="#EA4335"></path>
                    </g>
                </svg>
                {{ __('page.account.google') }}
            </div>
            <div class="major-provider facebook-login">
                <svg aria-hidden="true" class="svg-icon iconFacebook scale18" viewBox="0 0 18 18">
                    <path d="M1.88 1C1.4 1 1 1.4 1 1.88v14.24c0 .48.4.88.88.88h7.67v-6.2H7.46V8.4h2.09V6.61c0-2.07 1.26-3.2 3.1-3.2.88 0 1.64.07 1.87.1v2.16h-1.29c-1 0-1.19.48-1.19 1.18V8.4h2.39l-.31 2.42h-2.08V17h4.08c.48 0 .88-.4.88-.88V1.88c0-.48-.4-.88-.88-.88H1.88z" fill="#3C5A96">
                    </path>
                </svg>
                {{ __('page.account.facebook') }}
            </div>
        </div>
        <div class="ta-center fw-bold fc-light fs-fine my24">
            {{ __('page.account.or') }}
        </div>
        {!! Form::open(['id' => 'login-form', 'route' => 'home.postSignup']) !!}
            <div id="se-login-fields">
                {!! Form::label(__('user.username')) !!}
                <br>
                {!! Form::text('username', '', ['id' => 'display-name', 'placeholder' => 'P. Lam']) !!}
                <span class="errors">{{ $errors->first('username') }}</span>
                <br>
                {!! Form::label(__('user.email')) !!}
                <br>
                {!! Form::email('email', '', ['id' => 'email', 'placeholder' => 'you@example.org']) !!}
                <span class="errors">{{ $errors->first('email') }}</span>
                <br>
                {!! Form::label(__('user.password')) !!}
                <br>
                {!! Form::password('password', ['id' => 'password', 'autocomplete' => 'off', 'placeholder' => '********']) !!}
                <span class="errors">{{ $errors->first('password') }}</span>
                <br>
                {!! Form::label(__('user.rePassword')) !!}
                <br>
                {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'autocomplete' => 'off', 'placeholder' => '********']) !!}
                <span class="errors">{{ $errors->first('password_confirmation') }}</span>
                <br>
                <a id="forgot-pw" class="fr" href="{{ route('password.request') }}">{{ __('page.account.forgot') }}?</a>
                <br class="cbt">
                {!! Form::submit(__('page.account.signup'), ['class' => 's-btn s-btn__primary s-btn__md', 'id' => 'submit-button']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <div id="switch" class="bar-md">
        {{ __('page.account.haveAcc') }}? <a href="{{ route('home.login') }}">{{ __('page.account.login') }}</a>
    </div>
</div>
@endsection

@section('js')
@endsection
