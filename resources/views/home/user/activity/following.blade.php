@extends('home.user.master')

@section('tab')
<div id="tabs">
    <a href="{{ route('home.user.detail', $id) }}" data-shortcut="P">
        {{ __('page.user.profile') }}
    </a>
    <a href="{{ route('home.user.activity', $id) }}" class="youarehere" data-shortcut="A">
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
<div id="main-content">
    <div id="profile-side" class="l-col-secondary">
        <div id="side-menu">
            <ul>
                <li class="category">
                    {{ __('page.user.activity') }}
                    <ul>
                        <li>
                            <a href="{{ route('home.user.activity', $id) }}">
                                {{ __('page.user.activity') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.user.answer', $id) }}">
                                {{ __('page.user.answer') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.user.inbox', $id) }}">
                                {{ __('page.user.inbox') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.user.following', $id) }}" class="youarehere">
                                {{ __('page.user.following') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.user.follower', $id) }}">
                                {{ __('page.user.follower') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.user.followingTag', $id) }}">
                                {{ __('page.user.followingTag') }}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div id="mainbar">
        <h3>{{ __('page.user.list') }}:</h3>
        <div id="user-browser">
            <div class="grid-layout">
                <!-- posts section -->
                @forelse ($allFollowings as $key => $following)
                    @php
                        $user = $following->userFollowing
                    @endphp
                    <div class="grid-layout--cell user-info user-hover">
                        <div class="user-gravatar48">
                            <a href="#">
                                <div class="gravatar-wrapper-48">
                                    {{ Html::image('/' . config('constants.IMAGE_UPLOAD_PATH') . $user->image_path, '', ['class' => 'scale48']) }}
                                </div>
                            </a>
                        </div>
                        <div class="user-details">
                            <a href="{{ route('home.user.detail', $user->id) }}">{{ $user->username }}</a>
                            <span class="user-location">{{ $user->address }}</span>
                            <div class="-flair">
                                <span class="reputation-score" dir="ltr">{{ $user->posts->sum('total_vote') }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="question-summary">
                        <div class="summary">
                            <h3>
                                {{ __('page.followingEmpty') }}
                            </h3>
                        </div>
                    </div>
                @endforelse
                <!-- end post section -->
                @include('home.layout.pagination', ['paginator' => $allFollowings])
            </div>
        </div>
    </div>
</div>
@endsection
