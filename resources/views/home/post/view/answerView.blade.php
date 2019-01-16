@php
    $key = $input['key'] + 1;
@endphp
<div id="answer-{{ $key }}" class="answer newComment">
    <div class="post-layout">
        <div class="votecell post-layout--left">
            <div class="js-voting-container grid fd-column ai-stretch gs4 fc-black-150">
                {!! Form::open(['id' => 'answer-vote-' . $key, 'route' => 'home.post.postVote']) !!}
                    {{ Form::hidden('post_id', $input['post_id']) }}
                    {{ Form::hidden('answer_id', $answer->id) }}
                    {{ Form::hidden('', 0, ['id' => 'answer-vote-score-' . $key]) }}
                {!! Form::close() !!}
                <button class="answer-vote-up voteup{{ $key }} js-vote-up-btn grid--cell s-btn s-btn__unset c-pointer answer-vote answer-vote-{{ $key }}-up" data-key="{{ $key }}">
                    <svg class="svg-icon m0 iconArrowUpLg scale36">
                        <path d="M2 26h32L18 10z"></path>
                    </svg>
                </button>
                <div class="js-vote-count grid--cell fc-black-500 fs-title grid fd-column ai-center answer-vote-{{ $key }}-label">0</div>
                <button class="answer-vote-down votedown{{ $key }} js-vote-down-btn grid--cell s-btn s-btn__unset c-pointer answer-vote answer-vote-{{ $key }}-down" data-key="{{ $key }}">
                    <svg class="svg-icon m0 iconArrowDownLg scale36">
                        <path d="M2 10h32L18 26z"></path>
                    </svg>
                </button>
                @if (Auth::id() == $authorId)
                    <div class="vote-best-answer" data-answer-id="{{ $answer->id }}" data-post-id="{{ $input['post_id'] }}" data-action="{{ route('home.post.postBestAnswer') }}">
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
                        <a href="#" class="suggest-edit-post">{{ __('page.post.edit') }}</a>
                    </div>                    
                </div>
                <div class="post-signature owner grid--cell fl0">
                    <div class="user-info">
                        <div class="user-action-time">
                            {{ __('page.post.wrote') }} <span class="relativetime">{{ time_from_now($answer->created_at) }}</span>
                        </div>
                        @php
                            $currentUser = Auth::user();
                        @endphp
                        <div class="user-gravatar32 wb-hat-checked">
                            <a href="#">
                                <div class="gravatar-wrapper-32">
                                    {{ Html::image('/' . config('constants.IMAGE_UPLOAD_PATH') . $currentUser['image_path'], '', ['class' => 'scale32']) }}
                                </div>
                            </a>
                        </div>
                        <div class="user-details">
                            <a href="{{ route('home.user.detail', $currentUser['id']) }}">{{ $currentUser['username'] }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- answers replies -->
        <div class="post-layout--right">
            <div id="repliesAnswerBox{{ $key }}" class="comments js-comments-container">
            </div>
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
                        {{ Form::hidden('key', $key) }}
                        <div><span id="formReplyAnswers{{ $key }}Errors" class="errors"></span></div>
                        <div class="wmd-container mb8">
                            <a class="btn postComment" data-target="repliesAnswerBox{{ $key }}" data-form="formReplyAnswers{{ $key }}">{{ __('page.post.comment') }}</a>
                            <a class="hideForm">{{ __('page.user.btnCancel') }}</a>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <!-- end answers replies -->
    </div>
</div>
