<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta content="{{ csrf_token() }}" name="csrf-token">

    <title>Admin IT-FORUM</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

</head>
<body id="page-top">
    @include('admin.layout.header')
    <div id="wrapper">
        @include('admin.layout.sidebar')
        <div class="container-fluid" id="content">
                @yield('content')
        </div>
    </div>
    @include('admin.layout.logout')

    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
