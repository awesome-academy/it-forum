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
                            <a href="{{ route('home.user.activity', $id) }}" class="youarehere">
                                {{ __('page.user.activity') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.user.answer', $id) }}">
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
                    @if (!empty($allPostsUser))
                        @foreach ($allPostsUser as $key => $post)
                            <div class="question-summary narrow">
                                <div onclick="" class="cp">
                                </div>
                                <div class="summary">
                                    <h3>
                                        <a href="{{ route('home.post.detail', $post->id) }}" class="question-hyperlink">{{ $post->title }}</a>
                                    </h3>
                                    <div class="tags t-angular t-angular-material2">
                                        @foreach ($post->tags as $tag)
                                        <a href="{{ route('home.tag.detail', $tag->name) }}" class="post-tag" title="{{ $tag->name }}" rel="tag">{{ $tag->name }}</a> 
                                        @endforeach
                                    </div>
                                    <div class="started">
                                        <a href="{{ route('home.user.detail', $post->user->id) }}">{{ $post->user->username }}</a> 
                                        <a href="#" class="started-link">{{ __('page.post.wrote') }}
                                            <span class="relativetime">{{ time_from_now($post->created_at) }}</span></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <!-- end post section -->
                    @include('home.layout.pagination', ['paginator' => $allPostsUser])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
