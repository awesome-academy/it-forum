@extends('home.user.master')

@section('tab')
<div id="tabs">
    <a href="{{ route('home.user.setting') }}" class="youarehere">
        {{ __('page.user.setting') }}
    </a>
</div>
<div class="additional-links">
    <a href="{{ route('home.logout') }}">
        {{ __('page.user.logout') }}
    </a>
</div>
@endsection

@section('detail-content')
<div id="main-content">
    <div id="profile-side" class="l-col-secondary">
        <div id="side-menu">
            <ul>
                <li class="category">
                    {{ __('page.user.personalInfo') }}
                    <ul>
                        <li>
                            <a href="{{ route('home.user.setting') }}">
                                {{ __('page.user.editProfile') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.user.password') }}" class="youarehere">
                                {{ __('page.user.password') }}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div id="mainbar" class="user-show-new settings-page" style="width: 775px;">
        <div class="edit-profile edit-careers-profile">
            <h1>{{ __('page.user.editPassword') }}</h1>
            {!! Form::open(['id' => 'edit-password-form', 'route' => 'home.user.editPassword']) !!}
                <div id="user-edit-table" class="inner-container">
                    <div class="row first-row">
                        <div class="col-12">
                            {!! Form::label(__('user.oldPassword')) !!}
                            {!! Form::password('oldPassword', ['id' => 'oldPassword']) !!}
                            <span class="errors">{{ $errors->first('oldPassword') }}</span>
                            {!! Form::label(__('user.newPassword')) !!}
                            {!! Form::password('password', ['id' => 'password', 'autocomplete' => 'off']) !!}
                            <span class="errors">{{ $errors->first('password') }}</span>
                            {!! Form::label(__('user.newRePassword')) !!}
                            {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'autocomplete' => 'off']) !!}
                            <span class="errors">{{ $errors->first('password_confirmation') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">&nbsp;</div>
                    </div>
                </div>
                <div class="inner-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-submit" id="form-submit">
                                {!! Form::submit(__('page.user.btnEdit'), ['type' => 'button', 'id' => 'submit', 'autocomplete' => 'off']) !!}
                                <a href="{{ route('home.user.detail', $currentUser->id) }}" class="btn-default">
                                    {{ __('page.user.btnCancel') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
