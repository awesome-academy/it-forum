@extends('home.master')

@section('title', 'a')
@section('link-header')
@endsection

@section('content')
<div id="question-header" class="grid">
    <h1 itemprop="name" class="grid--cell fs-headline1 fl1 wb-break-word">
        <!-- ten cau hoi -->
        <a href="#" class="question-hyperlink">How to transform a 'bat' directive from Jenkinsfile for execution in the Script Console?</a>
    </h1>
    <div class="pl8 aside-cta grid--cell">
        <a href="#" class="d-inline-flex ai-center ws-nowrap s-btn s-btn__primary">{{ __('page.post.comment') }}</a>
    </div>
</div>
<div id="mainbar">
    <div class="question" id="question">
        <div class="post-layout">
            <div class="votecell post-layout--left">
                <div class="vote">
                    <input type="hidden" name="_id_" value="53702742">
                    <a class="vote-up-off" data-title="This question shows research effort; it is useful and clear">    {{ __('page.post.upVote') }}
                    </a>
                    <span itemprop="upvoteCount" class="vote-count-post">0</span>
                    <a class="vote-down-off" data-title="This question does not show any research effort; it is unclear or not useful">
                        {{ __('page.post.downVote') }}
                    </a>
                    <a class="star-off" href="#">{{ __('page.post.favorite') }}</a>
                    <div class="favoritecount"><b></b></div>
                </div>
            </div>
            <div class="postcell post-layout--right">
                <div class="post-text" itemprop="text">
                    <!-- cau tra loi -->
                    <p>A 'bat' script from my Jenkinsfile is failing for no apparent reason. I already tested it by physically running it on the agent machine, so now I want to run it under Jenkins manually - through the Script Console. How do I go about transforming this line into the exactly equivalent console command?</p>

                    <pre><code>bat 'set \"ANDROID_HOME=%USERPROFILE%\\AppData\\Local\\Android\\Sdk\" &amp;&amp; gradlew.bat assembleDebug'
                    </code></pre>

                    <p>I tried this, no luck, I probably didn't escape something correctly, perhaps too many inner quotes for the <code>cmd /c</code> command?</p>

                    <pre><code>"cmd \\c \"set \"ANDROID_HOME=%USERPROFILE%\\AppData\\Local\\Android\\Sdk\" &amp;&amp; gradlew.bat assembleDebug\" ".execute()
                    </code></pre>
                </div>
                <div class="post-taglist grid gs4 gsy fd-column">
                    <div class="grid ps-relative d-block">
                        <!-- cac tag -->
                        <a href="#" class="post-tag js-gps-track" data-title="show questions tagged &#39;jenkins&#39;" rel="tag">jenkins</a> 
                        <a href="#" class="post-tag js-gps-track" data-title="" rel="tag">jenkins-pipeline</a> 
                        <a href="#" class="post-tag js-gps-track" data-title="" rel="tag">jenkins-job-dsl</a> 
                    </div>
                </div>
                <div class="mb0 ">
                    <div class="mt16 pt4 grid gs8 gsy fw-wrap jc-end ai-start">
                        <div class="grid--cell mr16">
                            <div class="post-menu">
                                <a href="#" data-title="short permalink to this question" class="short-link" id="link-post-53702742">{{ __('page.post.share') }}</a>
                            </div>
                        </div>
                        <div class="post-signature owner grid--cell">
                            <div class="user-info user-hover">
                                <div class="user-action-time">
                                    <!-- thoi gian config bang plugin -->
                                    {{ __('page.post.wrote') }} <span data-title="2018-12-10 09:29:27Z" class="relativetime">1 min ago</span>
                                </div>
                                <div class="user-gravatar32">
                                    <a href="#">
                                        <div class="gravatar-wrapper-32">
                                            <img src="#" alt="" width="32" height="32">
                                        </div>
                                    </a>
                                </div>
                                <div class="user-details">
                                    <a href="#">Violet Giraffe</a>
                                    <div class="-flair">
                                        <span class="reputation-score" data-title="reputation score 14,264" dir="ltr">14.3k</span>
                                        <span data-title="26 gold badges">
                                            <span class="badge1"></span>
                                            <span class="badgecount">26</span>
                                        </span>
                                        <span data-title="130 silver badges">
                                            <span class="badge2"></span>
                                            <span class="badgecount">130</span>
                                        </span><span data-title="240 bronze badges">
                                            <span class="badge3"></span>
                                            <span class="badgecount">240</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="post-layout--right">
                <div id="comments-53702742" class="comments js-comments-container dno">
                    <ul class="comments-list js-comments-list">
                    </ul>
                </div>
                <div id="comments-link-53702742">
                    <a href="#" class="js-add-link comments-link disabled-link " data-title="Use comments to ask for more information or suggest improvements. Avoid answering questions in comments.">
                        {{ __('page.post.addComment') }}
                    </a>
                    <span class="js-link-separator dno">&nbsp;|&nbsp;</span>
                    <a href="#" class="js-show-link comments-link dno" data-title="expand to show all comments on this post"></a>
                </div>         
            </div>        
        </div>
    </div>
    <div id="dfp-isb" class="everyonelovesstackoverflow everyoneloves__inline-sidebar"></div>
    <div id="answers" class="no-answers">
        <a name="tab-top"></a>
        <div id="answers-header">
            <div class="subheader answers-subheader">
                <h2 data-answercount="0">
                </h2>
                <div class="answers-subheader-div">
                    <div id="tabs">
                        <a href="#tab-top" data-title="Answers with the latest activity first">
                            {{ __('post.active') }}
                        </a>
                        <a href="#tab-top" data-title="Answers in the order they were provided" data-value="oldest">
                            {{ __('post.oldest') }}
                        </a>
                        <a class="youarehere is-selected" href="#tab-top" data-title="Answers with the highest score first">
                            {{ __('post.votes') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <a name="new-answer"></a>
        {{-- Form signup --}}
        {{-- @include('home.post.form_signup') --}}
        {{-- End form signup --}}
        <h2 class="bottom-notice" data-loc="2">
            {{ __('page.post.lookingForMore') }}
            <a href="#">{{ __('page.post.allList') }}</a>, {{ __('page.post.or') }}
            <a href="#">{{ __('page.post.popularTag') }}</a>.
        </h2>
    </div>
</div>
@endsection

@section('rightbar')
{{-- include rightbar --}}
@include('home.layout.rightbar')
@endsection

@section('js')
<script>
    $('body').addClass('question-page unified-theme')
</script>
@endsection
