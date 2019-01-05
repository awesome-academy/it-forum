@extends('home.master')

@section('title', $tagName)
@section('link-header')
@endsection

@section('content')
{{-- mainbar --}}
<div id="mainbar">
    <div class="grid">
        <h1 class="grid--cell fl1 fs-headline1 mb24">
            {{ __('page.tag.info') }}
            <a href="{{ route('home.tag.detail', $tagName) }}" class="post-tag" title="{{ $tagName }}" rel="tag">{{ $tagName }}</a>
        </h1>
    </div>
    <div class="grid ai-center mb16">
        <div class="grid--cell fl1 fs-body3">
            {{ __('page.tag.info') }}
        </div>
        <div class="grid--cell">
            <div class="grid tabs-filter s-btn-group tt-capitalize">
                <a href="{{ route('home.tag.info', $tagName) }}"
                    class="is-selected is-selected grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    {{ __('page.tag.info') }}
                </a>
                <a href="{{ route('home.tag.detail', $tagName) }}"
                    class="grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    {{ __('page.tag.interesting') }}
                </a>
                <a href="{{ route('home.tag.detail', [$tagName, 'tab' => 'treding']) }}"
                    class="grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    <span class="bounty-indicator-tab">363</span>{{ __('page.tag.treding') }}
                </a>
                <a href="{{ route('home.tag.detail', [$tagName, 'tab' => 'week']) }}"
                    class="grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    {{ __('page.tag.week') }}
                </a>
                <a href="{{ route('home.tag.detail', [$tagName, 'tab' => 'month']) }}"
                    class="grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                    {{ __('page.tag.month') }}
                </a>
            </div>
        </div>
    </div>
    <div class="post-text">
        @if (!empty($tag->description))
            {!! $tag->description !!}
        @else
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
                        {{ __('page.tag.noInfo') }}
                    </h3>
                    <p>
                        {{ __('page.post.lookingForMore') }}
                        <a href="{{ route('home.tag.index') }}">{{ __('page.post.popularTag') }}</a>.
                    </p>
                </div>
            </div>
        @endif
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
            <a href="{{ route('home.tag.detail', $tag->name) }}" class="post-tag" rel="tag">
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
