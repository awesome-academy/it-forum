@extends('home.master')

@section('title', __('page.post.list'))
@section('link-header')
@endsection

@section('content')
<div id="mainbar">
    <div class="grid">
        <h1 class="grid--cell fl1 fs-headline1">
            {{ __('page.post.list') }}
        </h1>
        <div class="pl8 aside-cta grid--cell">
            <a href="{{ route('home.post.write') }}" class="d-inline-flex ai-center ws-nowrap s-btn s-btn__primary">
                {{ __('page.post.write') }}
            </a>
        </div>
    </div>
    <?php $input['tab'] = !empty($input['tab']) ? $input['tab'] : ''; ?>
    <div class="grid ai-center mb16">
        <div class="grid--cell fl1 fs-body3">
            {{ count($allPosts) }} {{ trans_choice('page.post.question', count($allPosts)) }}
        </div>
        <div class="grid--cell">
            <div class="grid tabs-filter s-btn-group tt-capitalize">
                <a href="{{ route('home.post.all') }}"
                    class="{{ empty($input['tab']) ? 'is-selected' : '' }} grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    {{ __('page.post.interesting') }}
                </a>
                <a href="{{ route('home.post.all', ['tab' => 'treding']) }}"
                    class="{{ ($input['tab'] == 'treding') ? 'is-selected' : '' }} grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    <span class="bounty-indicator-tab">363</span>{{ __('page.post.treding') }}
                </a>
                <a href="{{ route('home.post.all', ['tab' => 'week']) }}"
                    class="{{ ($input['tab'] == 'week') ? 'is-selected' : '' }} grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    {{ __('page.post.week') }}
                </a>
                <a href="{{ route('home.post.all', ['tab' => 'month']) }}"
                    class="{{ ($input['tab'] == 'month') ? 'is-selected' : '' }} grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    {{ __('page.post.month') }}
                </a>
            </div>
        </div>
    </div>
    <div id="qlist-wrapper" class="flush-left">
        <div id="question-mini-list">
            <div>
                <!-- posts section -->
                @forelse ($allPosts as $key => $post)
                    <div class="question-summary narrow">
                        <div class="cp">
                            <div class="votes">
                                <div class="mini-counts"><span>{{ $post->total_vote }}</span></div>
                                {{ trans_choice('page.post.votes', $post->total_vote) }}
                            </div>
                            <div class="status {{ ($post->total_answer > 0) ? 'answered' : '' }}">
                                <div class="mini-counts"><span>{{ $post->total_answer }}</span></div>
                                <div>{{ trans_choice('page.post.answers', $post->total_answer) }}</div>
                            </div>
                            <div class="views">
                                <div class="mini-counts"><span>{{ $post->total_view }}</span></div>
                                <div>{{ trans_choice('page.post.views', $post->total_view) }}</div>
                            </div>
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
                @empty
                    <div class="question-summary">
                        <div class="statscontainer">
                            <div class="stats">
                                <div class="vote">
                                    <div class="votes">
                                        <span class="vote-count-post">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="summary">
                            <h3>
                                {{ __('page.postEmpty') }}
                            </h3>
                            <p>
                                {{ __('page.post.lookingForMore') }}
                                <a href="{{ route('home.post.all') }}">{{ __('page.post.allList') }}</a>, {{ __('page.post.or') }}
                                <a href="{{ route('home.tag.index') }}">{{ __('page.post.popularTag') }}</a>.
                            </p>
                        </div>
                    </div>
                @endforelse
                <!-- end post section -->
            </div>
            <!-- pagination -->
            @include('home.layout.pagination', ['paginator' => $allPosts])
            <!-- end pagination -->
        </div>
    </div>
</div>
@endsection

@section('rightbar')
<div id="sidebar">
    <div id="hot-network-questions" class="module tex2jax_ignore">
        <h4>
            <a href="#" class="js-gps-track s-link s-link__inherit">
                {{ __('page.post.tredingPost') }}
            </a>
        </h4>
        <ul>
            @foreach ($treadingPost as $post)
            <li>
                <div class="favicon favicon-travel"></div>
                <a href="{{ route('home.post.detail', $post->id) }}" class="js-gps-track question-hyperlink mb0">
                    {{ $post->title }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection

@section('js')
<script>
    $('body').addClass('home-page unified-theme')
</script>
@endsection
