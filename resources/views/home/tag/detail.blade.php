@extends('home.master')

@section('title', $tagName)
@section('link-header')
@endsection

@section('content')
<div id="mainbar">
    <div class="grid">
        <h1 class="grid--cell fl1 fs-headline1 mb24">
            {{ __('page.tag.list') }} [{{ $tagName }}]
        </h1>
    </div>
    <?php $input['tab'] = !empty($input['tab']) ? $input['tab'] : ''; ?>
    <div class="grid ai-center mb16">
        <div class="grid--cell fl1 fs-body3">
            {{ $allPosts->count() }} {{ trans_choice('page.post.postCount', $allPosts->count()) }}
        </div>
        <div class="grid--cell">
            <div class="grid tabs-filter s-btn-group tt-capitalize">
                <a href="{{ route('home.tag.info', $tagName) }}"
                    class=" grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    {{ __('page.tag.info') }}
                </a>
                <a href="{{ route('home.tag.detail', $tagName) }}"
                    class="{{ empty($input['tab']) ? 'is-selected' : '' }} youarehere grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    {{ __('page.tag.interesting') }}
                </a>
                <a href="{{ route('home.tag.detail', [$tagName, 'tab' => 'treding']) }}"
                    class="{{ ($input['tab'] == 'treding') ? 'is-selected' : '' }} grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    <span class="bounty-indicator-tab">{{ $allPosts->count() }}</span>{{ __('page.tag.trending') }}
                </a>
                <a href="{{ route('home.tag.detail', [$tagName, 'tab' => 'week']) }}"
                    class="{{ ($input['tab'] == 'week') ? 'is-selected' : '' }} grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    {{ __('page.tag.week') }}
                </a>
                <a href="{{ route('home.tag.detail', [$tagName, 'tab' => 'month']) }}"
                    class="{{ ($input['tab'] == 'month') ? 'is-selected' : '' }} grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    {{ __('page.tag.month') }}
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
                        <div class="status answered">
                            <strong>{{ $post->total_answer }}</strong>{{ trans_choice('page.post.answers', $post->total_answer) }}
                        </div>
                    </div>
                    <div class="views">
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
                        {!! str_limit(strip_tags($post->content), config('constants.LIMIT_WORD')) !!}
                    </div>
                    <div class="tags">
                        @foreach ($post->tags as $tag)
                        <a href="{{ route('home.tag.detail', $tag->name) }}" class="post-tag" rel="tag">
                            {{ $tag->name }}
                        </a>
                        @endforeach
                    </div>
                    <div class="started fr">
                        <div class="user-info user-hover">
                            <div class="user-action-time">
                                {{ __('page.post.wrote') }} <span class="relativetime">{{ $post->created_at }}</span>
                            </div>
                            <div class="user-gravatar32">
                                <a href="{{ route('home.user.detail', $post->user->id) }}">
                                    <div class="gravatar-wrapper-32">
                                        {{ Html::image('/' . config('constants.IMAGE_UPLOAD_PATH') . $post->user->image_path, '', ['class' => 'scale32']) }}
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
    <div id="hot-network-questions" class="module tex2jax_ignore">
        <h4>
            <a href="#" class="js-gps-track s-link s-link__inherit">
                {{ __('page.tag.relatedTag') }}
            </a>
        </h4>
    </div>
    <div class="tags t-nodeûjs t-angular t-webpack t-angular6">
        @foreach ($relatedTags as $tag)
            <a href="{{ route('home.tag.detail', $tag->name) }}" class="post-tag" data-title="" rel="tag">
                {{ $tag->name }}
            </a>
        @endforeach
    </div>
</div>
@endsection

@section('js')
<script>
    $('body').addClass('tagged-questions-page unified-theme')
</script>
@endsection
