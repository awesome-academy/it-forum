<link rel="stylesheet" href="{{ asset('css/code.css') }}">
<body class="padding10px0px">
    <a href="{{ route('home.code.create') }}" id="button-code-create">{{ __('page.code.create') }}</a>
    <a href="{{ route('home.code.list') }}" id="button-code-list">{{ __('page.code.list') }}</a>
    <a href="{{ route('home.code.test') }}" id="button-code-test">{{ __('page.code.testEmbbed') }}</a>
    <p>{{ __('page.code.runCodeHtml') }}:</p>
    <iframe src="{{ route('home.code.show', '25bae7f751') }}" scrolling="no" class="iframe-embedded"></iframe>
    <p>{{ __('page.code.runCodePhp') }}:</p>
    <iframe src="{{ route('home.code.show', 'b71d994805') }}" scrolling="no" class="iframe-embedded"></iframe>
</body>
