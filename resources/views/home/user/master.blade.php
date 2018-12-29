@extends('home.master')

@section('title', 'Phạm Tùng Lâm')
@section('link-header')
@endsection

@section('content')
<div id="mainbar-full" class="user-show-new">
    <div class="subheader reloaded js-user-header" id="js-user-header1">
        @yield('tab')
    </div>
    <div id="main-content">
        @if (Session::has('success_alert'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success_alert') }}
        </div>
        @endif
        @if (Session::has('error_alert'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('error_alert') }}
        </div>
        @endif
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
