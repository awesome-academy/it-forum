<header class="top-bar js-top-bar _fixed top-bar__network">
    <div class="-container">
        <div class="-main">
            <a href="{{ route('home.index') }}" class="-logo js-gps-track">
                <span class="_glyph">Stack Overfollower</span>
            </a>
        </div>
        <?php $filterVal = !empty($tagName) ? '[' . $tagName. ']' : ''; ?>
        {!! Form::open(['id' => 'search', 'method' => 'GET', 'class' => 'searchbar js-searchbar']) !!}
            <div class="ps-relative">
                {!! Form::text('q', $filterVal, ['maxlength' => 240, 'class' => 'f-input js-search-field', 'placeholder' => __('layout.header.search') . '…']) !!}
            </div>
        {!! Form::close() !!}
        <ol class="-secondary js-secondary-topbar-links drop-icons-responsively the-js-is-handling-responsiveness">
            <li class="-item searchbar-trigger js-searchbar-trigger">
                <a href="#" class="-link">
                    <svg aria-hidden="true" class="svg-icon iconSearch" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M12.86 11.32L18 16.5 16.5 18l-5.18-5.14v-.35a7 7 0 1 1 1.19-1.19h.35zM7 12A5 5 0 1 0 7 2a5 5 0 0 0 0 10z">
                        </path>
                    </svg>
                </a>
            </li>
            <li class="-item">
                <a href="#" class="-link js-inbox-button" data-title="Recent inbox messages">
                    <svg aria-hidden="true" class="svg-icon iconInbox" width="20" height="18" viewBox="0 0 20 18">      <path d="M15.19 1H4.63c-.85 0-1.6.54-1.85 1.35L0 10.79V15c0 1.1.9 2 2 2h16a2 2 0 0 0 2-2v-4.21l-2.87-8.44A2 2 0 0 0 15.19 1zm-.28 10l-2 2h-6l-2-2H1.96L4.4 3.68A1 1 0 0 1 5.35 3h9.12a1 1 0 0 1 .95.68L17.86 11h-2.95z">
                        </path>
                    </svg>
                </a>
            </li>
            <li class="-item">
                <a href="#" class="-link js-achievements-button" data-title="Recent achievements: reputation, badges, and privileges earned">
                    <svg aria-hidden="true" class="svg-icon iconAchievements" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M15 2V1H3v1H0v4c0 1.6 1.4 3 3 3v1c.4 1.5 3 2.6 5 3v2H5s-1 1.5-1 2h10c0-.4-1-2-1-2h-3v-2c2-.4 4.6-1.5 5-3V9c1.6-.2 3-1.4 3-3V2h-3zM3 7c-.5 0-1-.5-1-1V4h1v3zm8.4 2.5L9 8 6.6 9.4l1-2.7L5 5h3l1-2.7L10 5h2.8l-2.3 1.8 1 2.7h-.1zM16 6c0 .5-.5 1-1 1V4h1v2z">
                        </path>
                    </svg>
                </a>
            </li>
            <li class="-item help-button-item" data-remove-order="1">
                <a href="#" class="-link js-help-button" data-title="Help Center and other resources">
                    <svg aria-hidden="true" class="svg-icon iconHelp" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M9 1a8 8 0 1 0 0 16A8 8 0 0 0 9 1zm.81 12.13c-.02.71-.55 1.15-1.24 1.13-.66-.02-1.17-.49-1.15-1.2.02-.72.56-1.18 1.22-1.16.7.03 1.2.51 1.17 1.23zM11.77 8a5.8 5.8 0 0 1-1.02.91l-.53.37c-.26.2-.42.43-.5.69a4 4 0 0 0-.09.75c0 .05-.03.16-.18.16H7.88c-.16 0-.18-.1-.18-.15.03-.66.12-1.21.4-1.66a5.29 5.29 0 0 1 1.43-1.22c.16-.12.28-.25.38-.39a1.34 1.34 0 0 0 .02-1.71c-.24-.31-.51-.46-1.03-.46-.51 0-.8.26-1.02.6-.21.33-.18.73-.18 1.1H5.75c0-1.38.35-2.25 1.1-2.76.52-.35 1.17-.5 1.93-.5 1 0 1.79.18 2.49.71.64.5.98 1.18.98 2.12 0 .57-.2 1.05-.48 1.44z">
                        </path>
                    </svg>
                </a>
            </li>
            <li class="-item">
                <a href="#" class="-link js-site-switcher-button js-gps-track" data-title="A list of all 174 Stack Exchange sites">
                    <svg aria-hidden="true" class="svg-icon iconStackExchange" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M1 13c0 1.1.9 2 2 2h8v3l3-3h1a2 2 0 0 0 2-2v-2H1v2zM15 1H3a2 2 0 0 0-2 2v2h16V3a2 2 0 0 0-2-2zM1 6h16v4H1V6z">
                        </path>
                    </svg>
                </a>
            </li>
            @if (Auth::check())
            <?php $currentUser = Auth::user(); ?>
            <li class="-ctas">
                <a href="{{ route('home.user.detail', $currentUser->id) }}" class="my-profile js-gps-track wb-hat-checked" data-gps-track="profile_summary.click()">
                    <div class="gravatar-wrapper-24" title="{{ $currentUser->username }}">
                        <img alt="" width="24" height="24" class="-avatar js-avatar-me"
                        title="{{ $currentUser->username }}"
                        src="/{{ config('constants.IMAGE_UPLOAD_PATH') . $currentUser->image_path }}"></div>
                    <div class="-rep js-header-rep" title="your reputation: 1">1</div>
                </a>
            </li>
            @else
            <li class="-ctas">
                <a href="{{ route('home.login') }}" class="login-link s-btn btn-topbar-clear py8" rel="nofollow">
                    {{ __('layout.header.login') }}
                </a>
                <a href="{{ route('home.signup') }}" class="login-link s-btn s-btn__primary py8 btn-topbar-primary">    {{ __('layout.header.signup') }}
                </a>
            </li>
            @endif
        </ol>
    </div>
</header>
