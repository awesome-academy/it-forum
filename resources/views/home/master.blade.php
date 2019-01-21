<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <script>
        window.Laravel = @php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); @endphp
    </script>
    @if (!auth()->guest())
        <script>
            window.Laravel.userId = @php echo auth()->user()->id; @endphp
        </script>
    @endif
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
    <script src="{{ asset('js/notifications.js') }}"></script>
    <script>
        var notifications = [];
        $(document).ready(function() {
            
            $('.nuxt-progress').animate({ width: '100%' }, 1000, function() {
                $('.nuxt-progress').css('opacity', 0);
            });

            $('body').addClass('users-page unified-theme');
            $('.alert-dismissible').fadeTo(3000, 500).slideUp(500);
            $('.js-inbox-button').click(function(event) {
                var mousePosY = ($(window).width() - ($('.js-inbox-button').offset().left + $('.js-inbox-button').outerWidth()));
                $('.inbox-dialog').toggle(100).css({
                    'right': mousePosY - 40,
                    'position': 'absolute',
                });
            });

            if(Laravel.userId) {
                $.get('/user/notifications', function (data) {
                    notifications = data.map(function(val) {
                        val.data.id = val.id;
                        
                        return val.data;
                    });
                });
                window.Echo.private(`App.User.${Laravel.userId}`).notification((notification) => {
                    addNotifications([notification], '#list-notifications');
                });
            }
        });
        $(document).mouseup(function(e) {
            var container = $('.inbox-dialog');
            var inboxButton = $('.js-inbox-li');

            if (!container.is(e.target) && container.has(e.target).length === 0
                && inboxButton.has(e.target).length === 0) {
                container.hide(100);
            }
        });
    </script>
    @yield('js')
</body>
</html>
