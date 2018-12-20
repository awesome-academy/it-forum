@extends('home.master')

@section('title', __('page.tag.questionTagged') . '[angular]')
@section('link-header')
@endsection

@section('content')
{{-- mainbar --}}
<div id="mainbar">
    <div class="grid">
        <h1 class="grid--cell fl1 fs-headline1 mb24">
            {{ __('page.tag.list') }} [angular]
        </h1>
        <div class="pl8 aside-cta grid--cell" role="navigation" aria-label="ask new question">
            <a href="#" class="d-inline-flex ai-center ws-nowrap s-btn s-btn__primary">{{ __('page.post.write') }}</a>
        </div>
    </div>
    <div class="grid ai-center mb16">
        <div class="grid--cell fl1 fs-body3">
            15 {{ trans_choice('page.tag.tag', 15) }}
        </div>
        <div class="grid--cell">
            <div class="grid tabs-filter s-btn-group tt-capitalize">
                <a href="#" class="grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap" data-title="The most recently asked questions">
                    {{ __('page.tag.new') }}
                </a>
                <a href="#" class="grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap" data-title="Questions with the most links">
                    {{ __('page.tag.popular') }}
                </a>
            </div>
        </div>
    </div>
    <div id="questions" class="flush-left">
        <div class="question-summary" id="question-summary-53519146">
            <div class="statscontainer">
                <div class="stats">
                    <div class="vote">
                        <div class="votes">
                            <span class="vote-count-post ">
                                <strong>10</strong>
                            </span>
                            <div class="viewcount">{{ trans_choice('page.post.votes', 77) }}</div>
                        </div>
                    </div>
                    <div class="status answered">
                        <strong>17</strong>{{ trans_choice('page.post.answers', 77) }}
                    </div>
                </div>
                <div class="views " data-title="214 views">
                    214 {{ trans_choice('page.post.views', 77) }}
                </div>
            </div>
            <div class="summary">
                <div class="bounty-indicator" data-title="this question has an open bounty worth 100 reputation">
                    +100
                </div>
                <h3>
                    <a href="#" class="question-hyperlink">
                        Node.js crashing during Angular 6 build with --watch
                    </a>
                </h3>
                <div class="excerpt">
                    I am using Node v8.12.0 on Mac (although I've seen this issue with Node 9.x versions, and also on Linux). 

                    I am developing Angular 6 app, and am running dev builds with --watch flag. The watch will ...
                </div>          
                <div class="tags t-nodeûjs t-angular t-webpack t-angular6">
                    <a href="#" class="post-tag" data-title="" rel="tag">
                        node.js
                    </a> 
                    <a href="#" class="post-tag" data-title="" rel="tag">
                        angular
                    </a> 
                    <a href="#" class="post-tag" data-title="show questions tagged &#39;webpack&#39;" rel="tag">
                        webpack
                    </a> 
                    <a href="#" class="post-tag" data-title="show questions tagged &#39;angular6&#39;" rel="tag">
                        angular6
                    </a> 
                </div>
                <div class="started fr">
                    <div class="user-info user-hover">
                        <div class="user-action-time">
                            <!-- i18n bang plugin -->
                            {{ __('page.post.wrote') }} <span data-title="2018-11-28 12:08:58Z" class="relativetime">Nov 28 at 12:08</span>
                        </div>
                        <div class="user-gravatar32">
                            <a href="#">
                                <div class="gravatar-wrapper-32">
                                    <img src="{{ asset('image/a.png') }}" alt="" width="32" height="32">
                                </div>
                            </a>
                        </div>
                        <div class="user-details">
                            <a href="#">danwellman</a>
                            <div class="-flair">
                                <span class="reputation-score" data-title="reputation score " dir="ltr">6,152</span>
                                <span data-title="4 gold badges">
                                    <span class="badge1"></span>
                                    <span class="badgecount">4</span>
                                </span>
                                <span data-title="36 silver badges">
                                    <span class="badge2"></span>
                                    <span class="badgecount">36</span>
                                </span>
                                <span data-title="62 bronze badges">
                                    <span class="badge3"></span>
                                    <span class="badgecount">62</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <div class="question-summary" id="question-summary-53557532">
            <div class="statscontainer">
                <div class="stats">
                    <div class="vote">
                        <div class="votes">
                            <span class="vote-count-post ">
                                <strong>0</strong>
                            </span>
                            <div class="viewcount">{{ trans_choice('page.post.votes', 0) }}</div>
                        </div>
                    </div>
                    <div class="status answered">
                        <strong>1</strong>{{ trans_choice('page.post.answers', 1) }}
                    </div>
                </div>
                <div class="views " data-title="48 views">
                    48 {{ trans_choice('page.post.views', 77) }}
                </div>
            </div>
            <div class="summary">
                <div class="bounty-indicator" data-title="this question has an open bounty worth 50 reputation">
                    +50
                </div>
                <h3>
                    <a href="#" class="question-hyperlink">
                        CircleCI Angular ng build - Allocation Failure (Memory issue)?
                    </a>
                </h3>
                <div class="excerpt">
                    We've been running our builds on circleci for a while. Recently (sometimes) they fail because of allocation failure when running ng build.

                    The specific build command we are using is 

                    ng build --prod ...
                </div>          
                <div class="tags t-nodeûjs t-angular t-memory t-circleci t-circleci-2û0">
                    <a href="#" class="post-tag" data-title="show questions tagged &#39;node.js&#39;" rel="tag">
                        node.js
                    </a> 
                    <a href="#" class="post-tag" data-title="show questions tagged &#39;angular&#39;" rel="tag">
                        angular
                    </a> 
                    <a href="#" class="post-tag" data-title="" rel="tag">
                        memory
                    </a> 
                    <a href="#" class="post-tag" data-title="show questions tagged &#39;circleci&#39;" rel="tag">
                        circleci
                    </a> 
                    <a href="#" class="post-tag" data-title="show questions tagged &#39;circleci-2.0&#39;" rel="tag">    circleci-2.0
                    </a> 
                </div>
                <div class="started fr">
                    <div class="user-info ">
                        <div class="user-action-time">
                            {{ __('page.post.wrote') }} <span data-title="2018-11-30 12:22:11Z" class="relativetime">Nov 30 at 12:22</span>
                        </div>
                        <div class="user-gravatar32">
                            <a href="#">
                                <div class="gravatar-wrapper-32">
                                    <img src="{{ asset('image/a.png') }}" alt="" width="32" height="32">
                                </div>
                            </a>
                        </div>
                        <div class="user-details">
                            <a href="#">Matt The Ninja</a>
                            <div class="-flair">
                                <span class="reputation-score" data-title="reputation score " dir="ltr">1,656</span>
                                <span data-title="2 gold badges">
                                    <span class="badge1"></span>
                                    <span class="badgecount">2</span>
                                </span>
                                <span data-title="14 silver badges">
                                    <span class="badge2"></span>
                                    <span class="badgecount">14</span>
                                </span>
                                <span data-title="35 bronze badges">
                                    <span class="badge3"></span>
                                    <span class="badgecount">35</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection

@section('rightbar')
{{-- include rightbar --}}
@include('home.layout.rightbar')
@endsection

@section('js')
<script>
    $('body').addClass('tagged-questions-page unified-theme')
</script>
@endsection
