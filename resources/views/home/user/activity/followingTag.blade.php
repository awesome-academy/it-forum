@extends('home.user.master')

@section('title', __('page.user.activity'))

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
                            <a href="{{ route('home.user.following', $id) }}">
                                {{ __('page.user.following') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.user.follower', $id) }}">
                                {{ __('page.user.follower') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.user.followingTag', $id) }}" class="youarehere">
                                {{ __('page.user.followingTag') }}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div id="mainbar">
        <h3>{{ __('page.tag.list') }}:</h3>
        <!-- posts section -->
        @forelse ($allFollowingTags as $key => $tagFollowing)
            @php
                $tag = $tagFollowing->tagFollowing
            @endphp
                <a href="{{ route('home.tag.detail', $tag->id) }}" class="post-tag">{{ $tag->name }}</a>
        @empty
            <div class="question-summary">
                <div class="summary">
                    <h3>
                        {{ __('page.followTagEmpty') }}
                    </h3>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
