@extends('home.user.master')

@section('tab')
<div id="tabs">
    <a href="{{ route('home.user.setting') }}" class="youarehere" data-shortcut="P">
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
                            <a href="{{ route('home.user.setting') }}" class="youarehere">
                                {{ __('page.user.editProfile') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.user.password') }}">
                                {{ __('page.user.password') }}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div id="mainbar" class="user-show-new settings-page">
        <div class="edit-profile edit-careers-profile">
            <h1>{{ __('page.user.editProfile') }}</h1>
            {!! Form::open(['id' => 'edit-profile-form', 'route' => 'home.user.editProfile']) !!}
                <div id="user-edit-table" class="inner-container">
                    <h2>{{ __('page.user.publicInfo') }}</h2>
                    <div class="row first-row">
                        <div class="col-3">
                            <div class="avatar-wrapper">
                                <div class="gravatar-wrapper-164">
                                    <img src="/{{ !empty($currentUser->image_path) ? config('constants.IMAGE_UPLOAD_PATH') . $currentUser->image_path : '' }}" alt="" width="164" height="164" class="main-image">
                                </div>
                                <a id="change-picture">{{ __('page.user.changeAvatar') }}</a>
                            </div>
                        </div>
                        <div class="col-9">
                            {!! Form::label(__('user.username')) !!}
                            {!! Form::text('username', $currentUser->username, ['id' => 'username']) !!}
                            <span class="errors">{{ $errors->first('username') }}</span>
                            {!! Form::label(__('user.fullname')) !!}
                            {!! Form::text('fullname', $currentUser->fullname, ['id' => 'fullname', 'autocomplete' => 'off']) !!}
                            <span class="errors">{{ $errors->first('fullname') }}</span>
                            {!! Form::label(__('user.address')) !!}
                            {!! Form::text('address', $currentUser->address, ['id' => 'address', 'autocomplete' => 'off']) !!}
                            <span class="errors">{{ $errors->first('address') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">&nbsp;</div>
                    </div>
                </div>
                <div id="web-presence" class="inner-container web-presence">
                    <h2>{{ __('page.user.socialAccount') }}</h2>
                    <div class="row" id="websiteLink">
                        <div class="col-4 with-padding">
                            <label>{{ __('page.user.websiteLink') }}</label>
                            <div class="input-icon">
                                <svg aria-hidden="true" class="svg-icon iconLink" width="18" height="18" viewBox="0 0 18 18">
                                    <path d="M2.9 9c0-1.16.94-2.1 2.1-2.1h3V5H5a4 4 0 1 0 0 8h3v-1.9H5A2.1 2.1 0 0 1 2.9 9zM13 5h-3v1.9h3a2.1 2.1 0 1 1 0 4.2h-3V13h3a4 4 0 1 0 0-8zm-7 5h6V8H6v2z"></path>
                                </svg>
                                <input name="WebsiteUrl" type="text" value="" data-default="" maxlength="200" tabindex="10" data-site="">
                            </div>
                        </div>
                        <div class="col-4 with-padding">
                            <label for="TwitterUrl">{{ __('page.user.twitterLink') }}</label>
                            <div class="input-icon">
                                <svg aria-hidden="true" class="svg-icon iconTwitter" width="18" height="18" viewBox="0 0 18 18">
                                    <path d="M17 4.04c-.59.26-1.22.43-1.88.51a3.3 3.3 0 0 0 1.44-1.81c-.64.37-1.34.64-2.09.79a3.28 3.28 0 0 0-5.6 2.99A9.3 9.3 0 0 1 2.12 3.1a3.28 3.28 0 0 0 1.02 4.38 3.28 3.28 0 0 1-1.49-.4v.03a3.29 3.29 0 0 0 2.64 3.22 3.34 3.34 0 0 1-1.48.06 3.29 3.29 0 0 0 3.07 2.28 6.58 6.58 0 0 1-4.85 1.36 9.33 9.33 0 0 0 5.04 1.47c6.04 0 9.34-5 9.34-9.33v-.42a6.63 6.63 0 0 0 1.63-1.7L17 4.04z" fill="#2AA3EF"></path>
                                </svg>
                                <input name="TwitterUrl" id="TwitterUrl" type="text" data-default="" maxlength="200" tabindex="11" data-site="">
                            </div>
                        </div>
                        <div class="col-4 with-padding">
                            <label for="GitHubUrl">{{ __('page.user.githubLink') }}</label>
                            <div class="input-icon">
                                <svg aria-hidden="true" class="svg-icon iconGitHub" width="18" height="18" viewBox="0 0 18 18">
                                    <path d="M9 1a8 8 0 0 0-2.53 15.59c.4.07.55-.17.55-.38l-.01-1.49c-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82a7.42 7.42 0 0 1 4 0c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48l-.01 2.2c0 .21.15.46.55.38A8.01 8.01 0 0 0 9 1z"></path>
                                </svg>
                                <input name="GitHubUrl" id="GitHubUrl" type="text" data-default="" maxlength="200" tabindex="12" data-site="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="inner-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-submit" id="form-submit">
                                {!! Form::submit(__('page.user.btnEdit'), ['type' => 'button', 'id' => 'address', 'autocomplete' => 'off']) !!}
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

    {!! Form::open(['id' => 'edit-image-form', 'route' => 'home.user.editImage', 'enctype' => 'multipart/form-data']) !!}
    {!! Form::file('image', ['class' => 'hidden', 'id' => 'input-file']) !!}
    {!! Form::close() !!}
</div>
@endsection

@section('js-setting-page')
<script type="text/javascript">
    $(function() {
        $('#change-picture').click(function() {
            event.preventDefault();
            $('#input-file').click();
        });
        $('#input-file').on('change', function() {
            $('#edit-image-form').submit();
        });
    });
</script>
@endsection
