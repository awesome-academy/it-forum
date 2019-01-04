@extends('home.user.master')

@section('tab')
<div id="tabs">
    <a href="{{ route('home.user.detail', $id) }}" class="youarehere" data-shortcut="P">
        {{ __('page.user.profile') }}
    </a>
    <a href="{{ route('home.user.activity', $id) }}" data-shortcut="A">
        {{ __('page.user.activity') }}
    </a>
</div>
<div class="additional-links">
    <a href="{{ route('home.logout') }}">
        {{ __('page.user.logout') }}
    </a>
</div>
@endsection

@section('detail-content')
<div id="user-card" class="mt24 user-card">
    <div class="grid gs24">
        <div class="grid--cell fl-shrink0 ws2 overflow-hidden">
            <div id="avatar-card" class="profile-avatar s-card mb16 p12 bc-black-3 ta-center">
                <div class="avatar mt16 mx-auto overflow-hidden">
                    <a class="d-block wb-hat-checked" href="{{ route('home.user.detail', $id) }}">
                        <div class="gravatar-wrapper-164">
                            <img alt="" width="164" height="164" class="avatar-user"
                            src="/{{ !empty($user->image_path) ? Config::get('constants.IMAGE_UPLOAD_PATH') . $user->image_path : '' }}">
                        </div>
                    </a>
                </div>
                <div class="my12 fw-normal lh-sm" title="reputation">
                    <div class="grid gs8 grid__center">
                        <div class="grid--cell fs-title fc-dark">1</div>
                        <div class="grid--cell fs-fine fc-light tt-uppercase">{{ __('page.user.reputation') }}</div>
                    </div>
                </div>
                <div class="m4">
                    <div class="grid gs4 grid__fl1">
                    </div>
                </div>
            </div>
        </div>
        <div class="grid--cell fl1">
            <div class="grid gs16">
                <div class="grid--cell fl1 overflow-x-hidden overflow-y-auto pr16 profile-user--about about empty-bio">
                    <div class="grid fd-column gs8 gsy">
                        <div class="grid--cell">
                            <h2 class="grid gs12 fw-wrap ai-center fs-headline1 lh-xs fw-bold fc-dark wb-break-all profile-user--name">
                                <div class="grid--cell">{{ $user->username }}</div>

                            </h2>
                        </div>
                        <h3 class="grid--cell fs-body3 fc-light lh-sm profile-user--role current-position">
                            {{ $user->fullname }}
                        </h3>
                        <div class="grid--cell mt16 fs-body2 profile-user--bio ">
                            @if (!empty($id) && $id == Auth::id())
                            <p>
                                <a href="{{ route('home.user.setting') }}">{{ __('page.user.clickEdit') }}</a>
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="grid--cell fl-shrink0 pr24">
                    <div class="ps-relative s-anchors s-anchors__inherit">
                        <ul class="list-reset grid gs8 gsy fd-column fc-medium">
                            <li class="grid--cell wb-break-word ow-break-word">
                                <div class="grid gs8 gsx ai-center">
                                    <div class="grid--cell fc-black-350">
                                        <svg aria-hidden="true" class="svg-icon iconLocation" width="18" height="18" viewBox="0 0 18 18">
                                            <path d="M8.1 17.7S2 9.9 2 6.38A6.44 6.44 0 0 1 8.5 0C12.09 0 15 2.86 15 6.38 15 9.91 8.9 17.7 8.9 17.7c-.22.29-.58.29-.8 0zm.4-8.45a2.75 2.75 0 1 0 0-5.5 2.75 2.75 0 0 0 0 5.5z"></path>
                                        </svg>
                                    </div>
                                    <div class="grid--cell fl1">{{ $user->address }}</div>
                                </div>
                            </li>
                            <li class="grid--cell wb-break-word ow-break-word">
                                <div class="grid gs8 gsx ai-center">
                                    <div class="grid--cell fc-black-350">
                                        <svg aria-hidden="true" class="svg-icon iconHistory" width="19" height="18" viewBox="0 0 19 18">
                                            <path d="M3 9a8 8 0 1 1 3.73 6.77L8.2 14.3A6 6 0 1 0 5 9l3.01-.01-4 4-4-4h3zm7-4h1.01L11 9.36l3.22 2.1-.6.93L10 10V5z"></path>
                                        </svg>
                                    </div>
                                    <div class="grid--cell fl1">
                                        {{ __('page.user.memberFor') }} <span title="2017-08-04 17:50:24Z">{{ time_from_now($user->created_at) }}</span>
                                    </div>
                                </div>
                            </li>
                            <li class="grid--cell wb-break-word ow-break-word">
                                <div class="grid gs8 gsx ai-center">
                                    <div class="grid--cell fc-black-350">
                                        <svg aria-hidden="true" class="svg-icon iconClock" width="18" height="18" viewBox="0 0 18 18">
                                            <path d="M9 17A8 8 0 1 1 9 1a8 8 0 0 1 0 16zm0-2A6 6 0 1 0 9 3a6 6 0 0 0 0 12zM8 5h1.01L9 9.36l3.22 2.1-.6.93L8 10V5z"></path>
                                        </svg>
                                    </div>
                                    <div class="grid--cell fl1">
                                        {{ __('page.user.lastSince') }} <span title="2018-12-23 04:50:24Z" class="relativetime">1 min ago</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
