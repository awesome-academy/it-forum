<link rel="stylesheet" href="{{ asset('css/code.css') }}">
<body class="padding10px0px">
    <a href="{{ route('home.code.index') }}" id="button-code-create">{{ __('page.code.back') }}</a>
    <p>{{ __('page.code.runCodeHtml') }}:</p>
    <iframe src="{{ route('home.code.embedded', '25bae7f751') }}" scrolling="no" class="iframe-embedded-test"></iframe>
    <p>{{ __('page.code.runCodePhp') }}:</p>
    <iframe src="{{ route('home.code.embedded', 'b71d994805') }}" scrolling="no" class="iframe-embedded-test"></iframe>
</body>
