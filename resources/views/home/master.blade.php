<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <!-- Tell the browser to be responsive to screen width -->
    {{-- <link rel="icon" href="{{ asset('icon/favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('icon/favicon.ico') }}"> --}}

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    @yield('link-header')
    @yield('css')
</head>
<body>
    <div id="nuxt-loading" class="nuxt-progress"></div>
    @include('home.layout.header')
    <div class="container">
        @include('home.layout.leftbar')
        <div id="content" class="snippet-hidden">
            @include('home.layout.alert')
            <div class="inner-content">
                @yield('mainbar-header')
                @yield('content')
                @yield('rightbar')
            </div>
        </div>
    </div>
    @include('home.layout.footer')
    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.nuxt-progress').animate({ width: "100%" }, 1000, function() {
                $('.nuxt-progress').css('opacity', 0);
            });

            $('body').addClass('users-page unified-theme');
            $('.alert-dismissible').fadeTo(3000, 500).slideUp(500);
        });
    </script>
    @yield('js')
</body>
</html>
