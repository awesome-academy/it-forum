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
            <a href="#" class="d-inline-flex ai-center ws-nowrap s-btn s-btn__primary">
                {{ __('page.post.write') }}
            </a>
        </div>
    </div>
    @php 
        $input['tab'] = !empty($input['tab']) ? $input['tab'] : '';
    @endphp
    <div class="grid ai-center mb16">
        <div class="grid--cell fl1 fs-body3"></div>
        <div class="grid--cell">
            <div class="grid tabs-filter s-btn-group tt-capitalize">
                <a href="{{ route('home.post.index') }}"
                    class="{{ empty($input['tab']) ? 'is-selected' : '' }} youarehere grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    {{ __('page.post.interesting') }}
                </a>
                <a href="{{ route('home.post.index', ['tab' => 'trending']) }}"
                    class="{{ ($input['tab'] == 'trending') ? 'is-selected' : '' }} grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    <span class="bounty-indicator-tab">{{ count($allPosts) }}</span>{{ __('page.post.trending') }}
                </a>
                <a href="{{ route('home.post.index', ['tab' => 'week']) }}"
                    class="{{ ($input['tab'] == 'week') ? 'is-selected' : '' }} grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    {{ __('page.post.week') }}
                </a>
                <a href="{{ route('home.post.index', ['tab' => 'month']) }}"
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
                        <div onclick="" class="cp">
                            <div class="votes">
                                <div class="mini-counts"><span>{{ $post->total_vote }}</span></div>
                                {{ trans_choice('page.post.votes', $post->total_vote) }}
                            </div>
                            @if (!empty($post->best_answer_id))
                                <div class="status answered-accepted">
                                    <div class="mini-counts"><span>{{ $post->total_answer }}</span></div>
                                    <div>{{ trans_choice('page.post.answers', $post->total_answer) }}</div>
                                </div>
                            @else
                                <div class="status {{ ($post->total_answer > 0) ? 'answered' : '' }}">
                                    <div class="mini-counts"><span>{{ $post->total_answer }}</span></div>
                                    <div>{{ trans_choice('page.post.answers', $post->total_answer) }}</div>
                                </div>
                            @endif
                            <div class="views">
                                <div class="mini-counts {{ ($post->total_view > config('constants.TOTAL_VIEW_HOT')) ? 'hot' : '' }}"><span>{{ $post->total_view }}</span></div>
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
                                <a href="#" class="started-link" title="{{ $post->created_at }}">{{ __('page.post.wrote') }}
                                    <span class="relativetime">{{ time_from_now($post->created_at) }}</span></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="question-summary" id="question-summary-53519146">
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
                        </div>
                    </div>
                @endforelse
                <!-- end post section -->
            </div>
        </div>
    </div>
    <br class="cbt">
    <h2 class="bottom-notice">
        {{ __('page.post.lookingForMore') }}
        <a href="{{ route('home.post.all') }}">{{ __('page.post.allList') }}</a>, {{ __('page.post.or') }}
        <a href="{{ route('home.tag.index') }}">{{ __('page.post.popularTag') }}</a>.
    </h2>
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
                <a href="{{ route('home.tag.detail', $tag->name) }}" class="post-tag" data-title="" rel="tag">
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
    $('body').addClass('home-page unified-theme')
</script>
@endsection
