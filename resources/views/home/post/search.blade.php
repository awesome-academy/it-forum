@extends('home.master')

@section('title', __('page.search.title') . ' ' . $input['q'])
@section('link-header')
@endsection

@section('content')
{{-- mainbar --}}
<div id="mainbar">
    <div class="grid">
        <h1 class="grid--cell fl1 fs-headline1 mb24">
            {{ __('page.search.title') . ' ' . $input['q'] }}
        </h1>
    </div>
    @php
        $input['tab'] = !empty($input['tab']) ? $input['tab'] : '';
    @endphp
    <div class="grid ai-center mb16">
        <div class="grid--cell fl1 fs-body3">
            {{ $allPosts->count() }} {{ trans_choice('page.tag.tag', $allPosts->count()) }}
        </div>
        <div class="grid--cell">
            <div class="grid tabs-filter s-btn-group tt-capitalize">
                <a href="{{ route('home.search', ['q' => $input['q']]) }}"
                    class="{{ empty($input['tab']) ? 'is-selected' : '' }} youarehere grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    {{ __('page.post.interesting') }}
                </a>
                <a href="{{ route('home.search', ['tab' => 'trending', 'q' => $input['q']]) }}"
                    class="{{ ($input['tab'] == 'trending') ? 'is-selected' : '' }} grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    <span class="bounty-indicator-tab">{{ $allPosts->count() }}</span>{{ __('page.post.trending') }}
                </a>
                <a href="{{ route('home.search', ['tab' => 'week', 'q' => $input['q']]) }}"
                    class="{{ ($input['tab'] == 'week') ? 'is-selected' : '' }} grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    {{ __('page.post.week') }}
                </a>
                <a href="{{ route('home.search', ['tab' => 'month', 'q' => $input['q']]) }}"
                    class="{{ ($input['tab'] == 'month') ? 'is-selected' : '' }} grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    {{ __('page.post.month') }}
                </a>
            </div>
        </div>
    </div>
    <div id="questions" class="flush-left">
        @forelse ($allPosts as $post)
            <div class="question-summary">
                <div class="statscontainer">
                    <div class="stats">
                        <div class="vote">
                            <div class="votes">
                                <span class="vote-count-post">
                                    <strong>{{ $post->total_vote }}</strong>
                                </span>
                                <div class="viewcount">{{ trans_choice('page.post.votes', $post->total_vote) }}</div>
                            </div>
                        </div>
                        @if (!empty($post->best_answer_id))
                            <div class="status answered-accepted">
                                <strong>{{ $post->total_answer }}</strong>{{ trans_choice('page.post.answers', $post->total_answer) }}
                            </div>
                        @else
                            <div class="status {{ ($post->total_answer > 0) ? 'answered' : '' }}">
                                <strong>{{ $post->total_answer }}</strong>{{ trans_choice('page.post.answers', $post->total_answer) }}
                            </div>
                        @endif
                    </div>
                    <div class="views {{ ($post->total_view > 100) ? 'hot' : '' }}">
                        {{ $post->total_view }} {{ trans_choice('page.post.views', $post->total_view) }}
                    </div>
                </div>
                <div class="summary">
                    <h3>
                        <a href="{{ route('home.post.detail', $post->id) }}" class="question-hyperlink">
                            {{ $post->title }}
                        </a>
                    </h3>
                    <div class="excerpt">
                        {!! str_limit(strip_tags($post->content), 400) !!}
                    </div>          
                    <div class="tags t-nodeûjs t-angular t-webpack t-angular6">
                        @foreach ($post->tags as $tag)
                        <a href="{{ route('home.tag.detail', $tag->name) }}" class="post-tag" data-title="" rel="tag">
                            {{ $tag->name }}
                        </a>
                        @endforeach
                    </div>
                    <div class="started fr">
                        <div class="user-info user-hover">
                            <div class="user-action-time" title="{{ $post->created_at }}">
                                {{ __('page.post.wrote') }} <span class="relativetime">{{ time_from_now($post->created_at) }}</span>
                            </div>
                            <div class="user-gravatar32">
                                <a href="#">
                                    <div class="gravatar-wrapper-32">
                                        {{ Html::image(image_upload_path($post->user->image_path), '', ['class' => 'scale24']) }}
                                    </div>
                                </a>
                            </div>
                            <div class="user-details">
                                <a href="{{ route('home.user.detail', $post->user->id) }}">{{ $post->user->username }}</a>
                            </div>
                        </div>
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
        @include('home.layout.pagination', ['paginator' => $allPosts])
    </div>
</div>
@endsection

@section('rightbar')
<div id="sidebar">
    @if (Auth::check())
        <div id="hot-network-questions" class="module tex2jax_ignore">
            <h4>
                <a href="#" class="js-gps-track s-link s-link__inherit">
                    {{ __('page.tag.ownTags') }}
                </a>
            </h4>
        </div>
        <div class="tags t-nodeûjs t-angular t-webpack t-angular6">
        @if (count($ownTags) > 0)
            @foreach ($ownTags as $tag)
                <a href="{{ route('home.tag.detail', $tag->name) }}" class="post-tag">
                    {{ $tag->name }}
                </a>
            @endforeach
            <a href="" rel="tag">
                ...
            </a>
        @else
            <p>{{ __('page.tag.noTag') }}...</p>
        @endif
        </div>
    @endif
    <div class="clearfix"></div>
    <div id="hot-network-questions" class="module tex2jax_ignore">
        <h4>
            <a href="#" class="js-gps-track s-link s-link__inherit">
                {{ __('page.post.trendingPost') }}
            </a>
        </h4>
        <ul>
            @foreach ($trendingPost as $post)
            <li>
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
    $('body').addClass('tagged-questions-page unified-theme')
</script>
@endsection
