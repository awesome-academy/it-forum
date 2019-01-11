@extends('home.master')

@section('title', __('page.post.write'))
@section('link-header')
<link rel="stylesheet" href="{{ asset('plugins/jquery-tageditor/jquery.tag-editor.css') }}">
@endsection

@section('content')
<div id="mainbar" class="ask-mainbar box-border">
    {!! Form::open(['id' => 'post-form', 'route' => 'home.post.postWrite']) !!}
        <div id="question-form">
            <div class="question-context-title">
                {{ __('page.post.write') }}
            </div>
            <div class="js-wz-element" id="post-title"> 
                <div class="form-item ask-title">
                    {!! Form::label('title', __('page.post.title'), ['class' => 's-label mb4']) !!}
                    {!! Form::text('title', '', ['id' => 'title', 'placeholder' => 'Your title', 'autocomplete' => 'off', 'class' => 's-input js-ask-title h100 mt0 ask-title-field']) !!}
                    <span class="errors">{{ $errors->first('title') }}</span>
                </div>
            </div>
            <div id="post-editor" class="post-editor js-post-editor js-wz-element">
                {!! Form::label('content', __('page.post.content'), ['class' => 's-label mb4 d-block']) !!}
                {!! Form::textarea('content', '', ['id' => 'editor']) !!}
                <span class="errors">{{ $errors->first('content') }}</span>
            </div>
            <div class="js-wz-element ps-relative" id="tag-editor">
                {!! Form::label('tags', __('page.post.tags'), ['class' => 's-label mb4 d-block']) !!}
                {!! Form::textarea('tags', null, ['id' => 'textareaTag']) !!}
                <span class="errors">{{ $errors->first('tags') }}</span>
            </div>
            <div class="js-wz-element" id="question-only-section">
                <div class="form-submit cbt grid gsx gs4 p0 mt32">
                    {!! Form::submit(__('page.post.post'), ['class' => 'grid--cell s-btn s-btn__primary s-btn__icon js-submit-button', 'id' => 'submit-button', 'autocomplete' => 'off']) !!}
                    <a href="{{ route('home.index') }}" class="grid--cell s-btn s-btn__danger discard-question">Cancel</a>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>
@endsection

@section('rightbar')
<div id="sidebar">
    <div class="content-page">
        <p>{{ __('page.write.welcome') }}</p>
        <p>{{ __('page.write.wContent') }}</p>
        <h2>{{ __('page.write.search') }}</h2>
        <p>{{ __('page.write.sContent') }}</p>
        <h2>{{ __('page.write.beOnTop') }}</h2>
        <p>{{ __('page.write.bContent') }}</p>
    </div>
</div>
<div id="answers"></div>
<div id="comment-div"></div>
@endsection

@section('js')
<script> var CKEDITOR_BASEPATH = '/plugins/ckeditor/'; </script>
<script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('plugins/ckeditor/config.js') }}"></script>
<script src="{{ asset('plugins/jquery-tageditor/jquery.tag-editor.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-tageditor/jquery.caret.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    $(function () {
        $('body').addClass('home-page unified-theme');

        $('#textareaTag').tagEditor({
            delimiter: ', ',
            placeholder: '...',
            maxTags: {{ config('constants.MAX_TAG', 6) }},
            minTags: {{ config('constants.MIN_TAG', 2) }}
        });
    });
</script>
@endsection
