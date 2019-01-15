@extends('home.master')

@section('title', $post->title)
@section('link-header')
@endsection

@section('content')
<div id="question-header" class="grid">
    <h1 class="grid--cell fs-headline1 fl1 wb-break-word">
        <a href="#" class="question-hyperlink">{{ $post->title }}</a>
        {{ Form::hidden('post_id', $post->id, ['id' => 'post_id']) }}
    </h1>
    <div class="pl8 aside-cta grid--cell">
        <a href="#" id="toComment" onclick="return false;" class="d-inline-flex ai-center ws-nowrap s-btn s-btn__primary">{{ __('page.post.comment') }}</a>
    </div>
</div>
<div id="mainbar">
    <div class="question" id="question">
        <div class="post-layout">
            <div class="votecell post-layout--left">
                <div class="js-voting-container grid fd-column ai-stretch gs4 fc-black-150">
                    {!! Form::open(['id' => 'post-vote', 'class' => '', 'route' => 'home.post.postVote' ]) !!}
                        {{ Form::hidden('post_id', $post->id) }}
                        {{ Form::hidden('', 0, ['id' => 'post-vote-score']) }}
                    {!! Form::close() !!}
                    <button class="{{ !empty($postVote) && $postVote->score == 1 ? 'is-selected' : '' }} js-vote-up-btn grid--cell s-btn s-btn__unset c-pointer post-vote post-vote-up" data-id="{{ $post->id }}">
                        <svg class="svg-icon m0 iconArrowUpLg scale36">
                            <path d="M2 26h32L18 10z"></path>
                        </svg>
                    </button>
                    <div class="js-vote-count grid--cell fc-black-500 fs-title grid fd-column ai-center post-vote-label">{{ $post->total_vote }}</div>
                    <button class="{{ !empty($postVote) && $postVote->score == -1 ? 'is-selected' : '' }} js-vote-down-btn grid--cell s-btn s-btn__unset c-pointer post-vote post-vote-down" data-id="{{ $post->id }}">
                        <svg class="svg-icon m0 iconArrowDownLg scale36">
                            <path d="M2 10h32L18 26z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="postcell post-layout--right">
                <div class="post-text">
                    {!! $post->content !!}
                </div>
                <div class="post-taglist grid gs4 gsy fd-column">
                    <div class="grid ps-relative d-block">
                        <!-- tags -->
                        @foreach ($post->tags as $tag)
                            <a href="{{ route('home.tag.detail', $tag->name) }}" title="{{ $tag->name }}" class="post-tag js-gps-track">{{ $tag->name }}</a> 
                        @endforeach
                        <!-- end tags -->
                    </div>
                </div>
                <div class="grid mb0 fw-wrap ai-start jc-end gs8 gsy">
                    <div class="grid--cell mr16 share-edit-post">
                        <div class="post-menu">
                            <a href="#" id="btnShare" class="short-link">{{ __('page.post.share') }}</a>
                            <span class="lsep">|</span>
                            @if (Auth::check())
                                @if (Auth::id() == $post->user->id)
                                    <a href="{{ route('home.post.edit', $post->id) }}" class="suggest-edit-post">{{ __('page.post.edit') }}</a>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="post-signature owner grid--cell fl0">
                        <div class="user-info">
                            <div class="user-action-time">
                                {{ __('page.post.wrote') }} 
                                <span class="relativetime" title="{{ $post->created_at }}">
                                    {{ time_from_now($post->created_at) }}
                                </span>
                            </div>
                            <div class="user-gravatar32 wb-hat-checked">
                                <a href="#">
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
            <!-- post replies -->
            <div class="post-layout--right">
                <div>
                    <div class="comments js-comments-container" id="repliesPostBox">
                        @foreach ($postReplies as $key => $prep)
                            <ul class="comments-list js-comments-list">
                                <li class="comment js-comment">
                                    <div class="js-comment-actions comment-actions">
                                    </div>
                                    <div class="comment-text js-comment-text-and-form">
                                        <div class="comment-body">
                                            <span class="comment-copy">{{ $prep->content }}</span>
                                            –&nbsp;
                                            <a href="{{ route('home.user.detail', $prep->user->id) }}" class="comment-user">{{ $prep->user->username }}</a>
                                            <span class="comment-date" title="{{ $prep->created_at }}">
                                                <a class="comment-link">
                                                    <span class="relativetime-clean">{{ time_from_now($prep->created_at) }}</span>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>

                @if (Auth::check())
                    <div>
                        <a class="js-add-link comments-link disabled-link showForm" data-form="formReplyPost">{{ __('page.post.addComment') }}</a>
                        <span class="js-link-separator dno">&nbsp;|&nbsp;</span>
                        <a href="#" class="js-show-link comments-link dno"> 
                        </a>
                    </div>

                    {!! Form::open(['id' => 'formReplyPost', 'class' => 'formReply hidden', 'route' => 'home.post.postComment']) !!}
                        <div id="post-editor" class="post-editor js-post-editor js-wz-element">
                            <div class="ps-relative">
                                <div class="wmd-container mb8">
                                    {!! Form::textarea('content', null, ['id' => 'wmd-button-bar', 'class' => 'wmd-button-bar btr-sm', 'rows' => '4']) !!}
                                </div>
                                {{ Form::hidden('target', 1) }}
                                <div><span id="formReplyPostErrors" class="errors"></span></div>
                                <div class="wmd-container mb8">
                                    <a class="btn postComment" data-target="repliesPostBox" data-form="formReplyPost">{{ __('page.post.comment') }}</a>
                                    <a class="hideForm">{{ __('page.user.btnCancel') }}</a>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                @endif
            </div>
            <!-- end post replies -->
        </div>
    </div>
    <div id="answers">
        <div id="answers-header">
            <div class="subheader answers-subheader">
                <h2>
                    <span id="answer-number"><?php echo count($answers) ?></span> {{ trans_choice('page.post.answers', count($post->answers)) }}
                </h2>   
            </div>
        </div>
        <!-- answers section -->
        <div id="answersPost">
        @if (!empty($answers))
            @forelse ($answers as $key => $answer)
                <div id="answer-{{ $key }}" class="answer">
                    <div class="post-layout">
                        <div class="votecell post-layout--left">
                            <div class="js-voting-container grid fd-column ai-stretch gs4 fc-black-150">
                                {!! Form::open(['id' => 'answer-vote-' . $key, 'route' => 'home.post.postVote']) !!}
                                    {{ Form::hidden('post_id', $post->id) }}
                                    {{ Form::hidden('answer_id', $answer->id) }}
                                    {{ Form::hidden('', 0, ['id' => 'answer-vote-score-' . $key]) }}
                                {!! Form::close() !!}
                                <button class="{{ !empty($answersVotes[$key]) && $answersVotes[$key]->score == 1 ? 'is-selected' : '' }} answer-vote-up voteup{{ $key }} js-vote-up-btn grid--cell s-btn s-btn__unset c-pointer answer-vote answer-vote-{{ $key }}-up" data-key="{{ $key }}">
                                    <svg class="svg-icon m0 iconArrowUpLg scale36">
                                        <path d="M2 26h32L18 10z"></path>
                                    </svg>
                                </button>
                                <div class="js-vote-count grid--cell fc-black-500 fs-title grid fd-column ai-center answer-vote-{{ $key }}-label">{{ $answer->total_vote }}</div>
                                <button class="{{ !empty($answersVotes[$key]) && $answersVotes[$key]->score == -1 ? 'is-selected' : '' }} answer-vote-down votedown{{ $key }} js-vote-down-btn grid--cell s-btn s-btn__unset c-pointer answer-vote answer-vote-{{ $key }}-down" data-key="{{ $key }}">
                                    <svg class="svg-icon m0 iconArrowDownLg scale36">
                                        <path d="M2 10h32L18 26z"></path>
                                    </svg>
                                </button>
                                @if ($answer->id == $answer->post->best_answer_id)
                                    <div class="vote-best-answer fc-green-500" data-answer-id="{{ $answer->id }}" data-post-id="{{ $post->id }}" data-action="{{ route('home.post.postBestAnswer') }}">
                                        <svg class="svg-icon iconCheckmarkLg scale36">
                                            <path d="M6 14l8 8L30 6v8L14 30l-8-8z"></path>
                                        </svg>
                                    </div>
                                @elseif (Auth::id() == $answer->user->id)
                                    <div class="vote-best-answer" data-answer-id="{{ $answer->id }}" data-post-id="{{ $post->id }}" data-action="{{ route('home.post.postBestAnswer') }}">
                                        <svg class="svg-icon iconCheckmarkLg scale36">
                                            <path d="M6 14l8 8L30 6v8L14 30l-8-8z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="answercell post-layout--right">
                            <div class="post-text">
                                {!! $answer->content !!}
                            </div>
                            <div class="grid mb0 fw-wrap ai-start jc-end gs8 gsy">
                                <div class="grid--cell mr16 share-edit-post">
                                    <div class="post-menu">
                                        @if (Auth::id() == $answer->user->id)
                                            <a href="#" class="suggest-edit-post">{{ __('page.post.edit') }}</a>
                                        @endif
                                    </div>                    
                                </div>
                                <div class="post-signature owner grid--cell fl0">
                                    <div class="user-info">
                                        <div class="user-action-time" title="{{ $answer->created_at }}">
                                            {{ __('page.post.wrote') }} <span class="relativetime">{{ time_from_now($answer->created_at) }}</span>
                                        </div>
                                        <div class="user-gravatar32 wb-hat-checked">
                                            <a href="#">
                                                <div class="gravatar-wrapper-32">
                                                    {{ Html::image('/' . config('constants.IMAGE_UPLOAD_PATH') . $answer->user->image_path, '', ['class' => 'scale24 -avatar js-avatar-me']) }}
                                                </div>
                                            </a>
                                        </div>
                                        <div class="user-details">
                                            <a href="{{ route('home.user.detail', $answer->user->id) }}">{{ $answer->user->username }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- answers replies -->
                        <div class="post-layout--right">
                            <div id="repliesAnswerBox{{ $key }}" class="comments js-comments-container">
                            @foreach ($answersReplies[$key] as $k => $arep)
                                <ul class="comments-list js-comments-list">
                                    <li class="comment js-comment">
                                        <div class="js-comment-actions comment-actions">
                                        </div>
                                        <div class="comment-text js-comment-text-and-form">
                                            <div class="comment-body">
                                                <span class="comment-copy">{{ $arep->content }}</span>
                                                –&nbsp;
                                                <a href="{{ route('home.user.detail', $arep->user->id) }}" class="comment-user">{{ $arep->user->username }}</a>
                                                <span class="comment-date">
                                                    <a class="comment-link" title="{{ $arep->created_at }}">
                                                        <span class="relativetime-clean">{{ time_from_now($arep->created_at) }}</span>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            @endforeach
                            </div>
                            @if (Auth::check())
                                <div>
                                    <a class="js-add-link comments-link disabled-link showForm" data-form="formReplyAnswers{{ $key }}">{{ __('page.post.addComment') }}</a>
                                    <span class="js-link-separator dno">&nbsp;|&nbsp;</span>
                                    <a href="#" class="js-show-link comments-link dno"></a>
                                </div>
                                {!! Form::open(['id' => 'formReplyAnswers' . $key, 'route' => 'home.post.postComment', 'class' => 'formReply hidden']) !!}
                                    <div class="post-editor js-post-editor js-wz-element">
                                        <div class="ps-relative"> 
                                            <div class="wmd-container mb8">
                                                {!! Form::textarea('content', null, ['id' => 'wmd-button-bar', 'class' => 'wmd-button-bar btr-sm', 'rows' => '4']) !!}
                                            </div>
                                            {{ Form::hidden('target', 2) }}
                                            {{ Form::hidden('answer_id', $answer->id) }}
                                            <div><span id="formReplyAnswers{{ $key }}Errors" class="errors"></span></div>
                                            <div class="wmd-container mb8">
                                                <a class="btn postComment" data-target="repliesAnswerBox{{ $key }}" data-form="formReplyAnswers{{ $key }}">{{ __('page.post.comment') }}</a>
                                                <a class="hideForm">{{ __('page.user.btnCancel') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            @endif 
                        </div>
                        <!-- end answers replies -->
                    </div>
                </div>
            @empty
                <?php $key = 0; ?>
            @endforelse
        @endif
        </div>
    </div>
    <div id="comment-div">
        @if (!Auth::check())
            <h2 class="bottom-notice">
                {!! __('page.account.dontLoggedYet', [
                    'login' => '<a href="' . route('home.login') . '">' . __('page.account.login') . '</a>',
                    'signup' => '<a href="' . route('home.signup') . '">' . __('page.account.signup') . '</a>',
                ]) !!}
            </h2>
        @else
        <!-- end answers section -->
        {!! Form::open(['id' => 'formAnswer', 'route' => 'home.post.postComment']) !!}
            <h2 class="space">{{ __('page.post.comment') }}</h2>
            <div class="post-editor js-post-editor js-wz-element">
                <div class="ps-relative"> 
                    <div class="wmd-container mb8">
                        {!! Form::textarea('content', null, ['id' => 'editor', 'class' => 'wmd-button-bar btr-sm', 'rows' => '8']) !!}
                    </div>
                    {{ Form::hidden('target', 3) }}
                    {{ Form::hidden('key', $key, ['id' => 'keyInput']) }}
                    <div><span id="formAnswerErrors" class="errors"></span></div>
                    <div class="wmd-container mb8">
                        <a class="btn postComment" data-ckeditor="yes" data-target="answersPost" data-form="formAnswer">{{ __('page.post.comment') }}</a>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
        @endif
    </div>
</div>
@endsection

@section('rightbar')
{{-- include rightbar --}}
<div id="sidebar">
    <div class="module question-stats info1">
        <table id="qinfo">
            <tbody>
                <tr>
                    <td>
                        <p class="label-key">{{ __('page.post.asked') }}</p>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td class="td">
                        <p class="label-key">
                            <b>
                                <time>{{ time_from_now($post->created_at) }}</time>
                            </b>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="label-key">{{ __('page.post.viewed') }}</p>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td class="td">
                        <p class="label-key">
                            <b>{{ $post->total_view }} {{ trans_choice('page.post.times', $post->total_view) }}</b>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="label-key">{{ __('page.post.answered') }}</p>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td class="td">
                        <p class="label-key">
                            <b>
                                <a id="toAnswer">{{ $post->total_answer }}</a>
                            </b>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="hot-network-questions" class="module tex2jax_ignore">
        <h4>
            <a href="#" class="js-gps-track s-link s-link__inherit">
                {{ __('page.post.related') }}
            </a>
        </h4>
        <ul>
            @foreach ($relatedPost as $post)
            <li>
                <div class="favicon favicon-travel" data-title="Travel Stack Exchange"></div>
                <a href="{{ route('home.post.detail', $post->id) }}" class="js-gps-track question-hyperlink mb0">
                    <!-- ten cau hoi -->
                    {{ $post->title }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection

@section('js')
<script> var CKEDITOR_BASEPATH = '/plugins/ckeditor/'; </script>
<script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('plugins/ckeditor/config.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    $(document).ready(function($) {
        $('body').addClass('question-page unified-theme')
    });
</script>
@endsection
