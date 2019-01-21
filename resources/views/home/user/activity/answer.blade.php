@extends('home.user.master')

@section('title', __('page.user.activity'))

@section('tab')
<div id="tabs">
    <a href="{{ route('home.user.detail', $id) }}">
        {{ __('page.user.profile') }}
    </a>
    <a href="{{ route('home.user.activity', $id) }}" class="youarehere">
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
                            <a href="{{ route('home.user.answer', $id) }}" class="youarehere">
                                {{ __('page.user.answer') }}
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
        <div id="qlist-wrapper" class="flush-left">
            <div id="question-mini-list">
                <div>
                    <!-- posts section -->
                    @if (!empty($allAnswersUser))
                        @foreach ($allAnswersUser as $key => $answer)
                            <div id="answer-{{ $key }}" class="answer">
                                <h3 class="">
                                    <a href="{{ route('home.post.detail', $answer->post->id) }}" class="">{{ $answer->post->title }}</a>
                                </h3>
                                <div class="post-layout">
                                    <div class="votecell post-layout--left">
                                        <div class="js-voting-container grid fd-column ai-stretch gs4 fc-black-150">
                                            <div class="label label-default js-vote-count grid--cell fc-black-500 fs-title grid fd-column ai-center">{{ $answer->total_vote }}</div>
                                            <div class="js-accepted-answer-indicator grid--item fc-green-500 ta-center p4 d-none">
                                                <svg class="svg-icon iconCheckmarkLg scale36">
                                                    <path d="M6 14l8 8L30 6v8L14 30l-8-8z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="answercell post-layout--right">
                                        <div class="post-text">
                                            {!! $answer->content !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <!-- end post section -->
                    @include('home.layout.pagination', ['paginator' => $allAnswersUser])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
