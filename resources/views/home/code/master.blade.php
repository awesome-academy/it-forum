<!DOCTYPE html>
<html lang="en">
<head>

    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/codemirror/lib/codemirror.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/codehtml.css') }}">
    @yield('css')
</head>
<body>
    @yield('content')

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <!-- Plugin JS -->
    <script src="{{ asset('plugins/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/addon/edit/matchbrackets.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/addon/edit/closetag.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/addon/fold/xml-fold.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/addon/edit/matchtags.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/mode/javascript/javascript.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/mode/css/css.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/mode/clike/clike.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/mode/php/php.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
    @yield('js')
</body>
</html>
