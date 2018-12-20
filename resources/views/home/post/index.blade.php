@extends('home.master')

@section('title', __('post.title'))
@section('link-header')
@endsection

@section('content')
<div id="mainbar">
    <div class="grid">
        <h1 class="grid--cell fl1 fs-headline1">
            {{ __('page.post.list') }}
        </h1>
        <div class="pl8 aside-cta grid--cell" role="navigation" aria-label="ask new question">
            <a href="#" class="d-inline-flex ai-center ws-nowrap s-btn s-btn__primary">
                {{ __('page.post.write') }}
            </a>
        </div>
    </div>
    <div class="grid ai-center mb16">
        <div class="grid--cell fl1 fs-body3"></div>
        <div class="grid--cell">
            <div class="grid tabs-filter s-btn-group tt-capitalize">
                <a href="#" class="youarehere is-selected grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap" data-title="Questions that may be of interest to you based on your history and tag preference">
                    {{ __('page.post.interesting') }}
                </a>
                <a href="#" class="grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap" data-title="Questions with an active bounty">
                    <span class="bounty-indicator-tab">363</span>{{ __('page.post.treding') }}
                </a>
                <a href="#" class="grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap" data-title="Questions with the most views, answers, and votes this week">
                    {{ __('page.post.week') }}
                </a>
                <a href="#" class="grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap" data-title="Questions with the most views, answers, and votes this month">
                    {{ __('page.post.month') }}
                </a>
            </div>
        </div>
    </div>
    <div id="qlist-wrapper" class="flush-left">
        <div id="question-mini-list">
            <div>
                <div class="question-summary narrow" id="question-summary-53694850">
                    <div onclick="" class="cp">
                        <div class="votes">
                            <div class="mini-counts"><span data-title="0 votes">0</span></div>
                            {{ trans_choice('page.post.votes', 0) }}
                        </div>
                        <div class="status answered">
                            <div class="mini-counts"><span data-title="1 answer">1</span></div>
                            <div>{{ trans_choice('page.post.answers', 1) }}</div>
                        </div>
                        <div class="views">
                            <div class="mini-counts"><span data-title="17 views">17</span></div>
                            <div>{{ trans_choice('page.post.views', 17) }}</div>
                        </div>
                    </div>
                    <div class="summary">
                        <h3>
                            <!-- ten cau hoi -->
                            <a href="#" class="question-hyperlink">FormArray on save button click does not display mat error</a>
                        </h3>
                        <div class="tags t-angular t-angular-material2">
                            <a href="#" class="post-tag" data-title="show questions tagged &#39;angular&#39;" rel="tag">angular</a> 
                            <a href="#" class="post-tag" data-title="show questions tagged &#39;angular-material2&#39;" rel="tag">angular-material2</a> 
                        </div>
                        <div class="started">
                            <a href="#" class="started-link">{{ __('page.post.wrote') }}
                                <!-- i18n bang plugin moment -->
                                <span data-title="2018-12-10 07:17:06Z" class="relativetime">1 min ago</span></a>
                            <a href="#">Milad Bahmanabadi</a> 
                            <span class="reputation-score" data-title="reputation score " dir="ltr">430</span>
                        </div>
                    </div>
                </div>
                <div class="question-summary narrow" id="question-summary-53671167">
                    <div onclick="" class="cp">
                        <div class="votes">
                            <div class="mini-counts"><span data-title="0 votes">1</span></div>
                            {{ trans_choice('page.post.votes', 1) }}
                        </div>
                        <div class="status answered">
                            <div class="mini-counts"><span data-title="1 answer">0</span></div>
                            <div>{{ trans_choice('page.post.answers', 0) }}</div>
                        </div>
                        <div class="views">
                            <div class="mini-counts"><span data-title="17 views">12</span></div>
                            <div>{{ trans_choice('page.post.views', 12) }}</div>
                        </div>
                    </div>
                    <div class="summary">
                        <div class="bounty-indicator" data-title="this question has an open bounty worth 50 reputation">+50</div>
                        <!-- ten cau hoi -->
                        <h3><a href="#" class="question-hyperlink">pygraphviz multiple edges from the same node aren't working on Mac OS X</a></h3>
                        <div class="tags t-python-3ûx t-macos t-pygraphviz">
                            <a href="#" class="post-tag" data-title="show questions tagged &#39;python-3.x&#39;" rel="tag">python-3.x</a> 
                            <a href="#" class="post-tag" data-title="show questions tagged &#39;macos&#39;" rel="tag">macos</a> 
                            <a href="#" class="post-tag" data-title="show questions tagged &#39;pygraphviz&#39;" rel="tag">pygraphviz</a> 
                        </div>
                        <div class="started">
                            <a href="#" class="started-link">{{ __('page.post.wrote') }}
                                <span data-title="2018-12-10 06:44:17Z" class="relativetime">33 mins ago</span>
                            </a>
                            <a href="#">{{ __('post.inline') }}</a> 
                            <span class="reputation-score" data-title="reputation score " dir="ltr">587</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br class="cbt">
    <h2 class="bottom-notice" data-loc="2">
        {{ __('page.post.lookingForMore') }}
        <a href="#">{{ __('page.post.allList') }}</a>, {{ __('page.post.or') }}
        <a href="#">{{ __('page.post.popularTag') }}</a>.
    </h2>
</div>
@endsection

@section('rightbar')
{{-- include rightbar --}}
@include('home.layout.rightbar')
@endsection

@section('js')
<script>
    $('body').addClass('home-page unified-theme')
</script>
@endsection
