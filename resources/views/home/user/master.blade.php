@extends('home.master')

@section('title', __('page.user.profile'))

@section('link-header')
@endsection

@section('content')
<div id="mainbar-full" class="user-show-new">
    <div class="subheader reloaded js-user-header" id="js-user-header1">
        @yield('tab')
    </div>
    <div id="main-content">
        @yield('detail-content')
    </div>
</div>
@endsection

@section('rightbar')
@endsection

@section('js')

<script>
    $('body').addClass('users-page unified-theme');
    $('.alert-dismissible').fadeTo(3000, 500).slideUp(500, function() {
        $('.alert-dismissible').alert('close');
    });
</script>
@yield('js-setting-page')
@endsection
