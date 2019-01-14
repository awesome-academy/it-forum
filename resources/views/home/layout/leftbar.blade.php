<div id="left-sidebar" data-is-here-when="md lg" class="left-sidebar js-pinned-left-sidebar">
    <div class="left-sidebar--sticky-container js-sticky-leftnav">
        <nav role="navigation">
            <ol class="nav-links">
                <li>    
                </li>
                <li class="{{ in_array(getCurrentRouteName(), ['home.post.write', 'home.post.edit', 'home.index']) ? 'youarehere' : '' }}">
                    <a href="{{ route('home.index') }}" class="pl8 js-gps-track nav-links--link">
                        {{ __('layout.leftbar.home') }}        
                    </a>
                </li>
                <li>
                    <ol class="nav-links">
                        <li class="fs-fine tt-uppercase ml8 mt16 mb4 fc-light">{{ __('layout.leftbar.public') }}</li>
                        <li class="{{ in_array(getCurrentRouteName(), ['home.login', 'home.signup']) ? 'youarehere' : '' }}">
                            <a id="nav-questions" href="{{ route('home.index') }}" class="pl8 js-gps-track nav-links--link -link__with-icon">
                                <svg aria-hidden="true" class="svg-icon iconGlobe scale18" viewBox="0 0 18 18">
                                    <path d="M9 1a8 8 0 1 0 0 16A8 8 0 0 0 9 1zM8 15.32a6.4 6.4 0 0 1-5.23-7.75L7 11.68v.8c0 .88.12 1.32 1 1.32v1.52zm5.72-2c-.2-.66-1-1.32-1.72-1.32h-1v-2c0-.44-.56-1-1-1H6V7h1c.44 0 1-.56 1-1V5h2c.88 0 1.4-.72 1.4-1.6v-.33a6.4 6.4 0 0 1 2.32 10.24z">
                                    </path>
                                </svg>
                                <span class="-link--channel-name">Stack OverFollower
                                </span>
                            </a>
                        </li>
                        <li class="{{ in_array(getCurrentRouteName(), ['home.post.index', 'home.post.all', 'home.post.detail']) ? 'youarehere' : '' }}">
                            <a id="nav-tags" href="{{ route('home.post.index') }}" class="js-gps-track nav-links--link">
                                {{ __('layout.leftbar.post') }}
                            </a>
                        </li>
                        <li class="{{ in_array(getCurrentRouteName(), ['home.tag.detail', 'home.tag.index', 'home.tag.info']) ? 'youarehere' : '' }}">
                            <a id="nav-tags" href="{{ route('home.tag.index') }}" class=" js-gps-track nav-links--link">
                                {{ __('layout.leftbar.tag') }}
                            </a>
                        </li>
                        <li class="{{ in_array(getCurrentRouteName(), ['home.user.detail', 'home.user.index', 'home.user.setting', 'home.user.activity', 'home.user.answer', 'home.user.password']) ? 'youarehere' : '' }}">
                            <a id="nav-users" href="{{ route('home.user.index') }}" class=" js-gps-track nav-links--link">
                                {{ __('layout.leftbar.user') }}        
                            </a>
                        </li>
                    </ol>
                </li>
                <li>
                    <ol class="nav-links">
                        <li class="p6">
                            <div class="ba bc-black-2 bar-sm p16 grid fd-column ps-relative overflow-hidden">
                                <span class="grid--cell mt2 fs-caption fc-medium">{{ __('layout.leftbar.qa') }} </span>
                                <a href="#" class="js-gps-track s-btn s-btn__outlined ta-center grid--cell mt12">
                                    {{ __('layout.leftbar.learnMore') }}
                                </a>
                                <div class="ps-absolute t4 rn6">
                                    <svg class="scale53" fill="none">
                                        <path d="M49 11l.2 31H18.9L9 49v-7H4V8h31" fill="#CCEAFF"></path>
                                        <path d="M44.5 19v-.3l-.2-.1-18-13-.1-.1H.5v33h4V46l.8-.6 9.9-6.9h29.3V19z" stroke="#1060E1" stroke-miterlimit="10"></path>
                                        <path d="M31 2l6-1.5 7 2V38H14.9L5 45v-7H1V6h25l5-4z" fill="#fff"></path>
                                        <path d="M7 16.5h13m-13 6h14m-14 6h18" stroke="#1060E1" stroke-miterlimit="10"></path>
                                        <path d="M39 30a14 14 0 1 0 0-28 14 14 0 0 0 0 28z" fill="#FFB935"></path>
                                        <path d="M50.5 14a13.5 13.5 0 1 1-27 0 13.5 13.5 0 0 1 27 0z" stroke="#F48024" stroke-miterlimit="10"></path>
                                        <path d="M32.5 21.5v-8h9v8h-9zm2-9.5V9.3A2.5 2.5 0 0 1 37 6.8a2.5 2.5 0 0 1 2.5 2.5V12h-5zm2 3v2m1-2v2" stroke="#fff" stroke-miterlimit="10"></path>
                                    </svg>
                                </div>
                            </div>
                        </li>
                    </ol>
                </li>
            </ol>
        </nav>
    </div>
</div>
