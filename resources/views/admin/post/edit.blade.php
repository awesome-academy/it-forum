@extends('admin.master')

@section('link-header')
    <link rel="stylesheet" href="{{ asset('plugins/jquery-tageditor/jquery.tag-editor.css') }}">
@endsection

@section('content')
<div class="card m-1">
    <div class="card-header">
        <div id="mainbar-full" class="tag-show-new">
            <div id="main-content">
                @if (Session::has('success_alert'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success_alert') }}
                    </div>
                @endif
                @if (Session::has('error_alert'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error_alert') }}
                    </div>
                @endif
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger fade show" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class='pt-sm-3 pt-md-2'>
            <h5>
                <i class="fas fa-table"></i>
                {{ __('admin.action.editPost') }}
            </h5>
        </div>
    </div>
    <div class="card-body form-validation">
        {!! Form::open(['class' => 'form-validation', 'route' => 'admin.post.update', 'novalidate']) !!}
            {{ csrf_field() }}
            {!! Form::hidden('id', $post->id, ['id' => 'id', 'class' => 'form-control']) !!}
            <div class="form-row">
                <div class="form-group col-md-6">
                    {!! Form::label('title', __('admin.form.title')) !!}
                    {!! Form::text('title', $post->title, ['id' => 'title', 'class' => 'form-control', 'placeholder' => '*', 'required']) !!}
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('user_name', __('admin.form.username')) !!}
                    {!! Form::text('user_name', $post->user->username, ['id' => 'user_id', 'class' => 'form-control disable', 'placeholder' => '*', 'required', 'readonly']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('content', __('admin.form.content')) !!}
                {!! Form::textarea('content', $post->content, ['id' => 'editor', 'class' => 'form-control', 'placeholder' => '*', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('content', __('admin.category.tag')) !!}
                {!! Form::textarea('tags', $tags, ['id' => 'textareaTag']) !!}
            </div>
            <div class="form-group">
                <div class="form-check">
                    {!! Form::checkbox('status', '1', config('constants.CHECKBOX.' . $post->status), ['id' => 'status', 'class' => 'form-check-input']) !!}
                    {!! Form::label('status', __('admin.active'), ['class' => 'form-check-label']) !!}
                </div>
            </div>
            {!! Form::submit(__('admin.action.editPost'), ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('script')
<script> var CKEDITOR_BASEPATH = '/plugins/ckeditor/'; </script>
<script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('plugins/ckeditor/config.js') }}"></script>
<script src="{{ asset('plugins/jquery-tageditor/jquery.tag-editor.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-tageditor/jquery.caret.min.js') }}"></script>
<script>
    $(document).ready(function($) {
        $('body').addClass('question-page unified-theme')
    });
    editor = CKEDITOR.replace('editor');
    if (editor) {
        CKEDITOR.on('instanceReady', function(evt) {
            evt.editor.dataProcessor.htmlFilter.addRules({
                elements: {
                    img: function(el) {
                        el.addClass('img-responsive');
                    }
                }
            });
        });
        editor.addCommand('mySimpleCommand', {
            exec: function(edt) {
                var person = prompt('Please enter your name');

                if (!person) {
                    alert('Hãy nhập url!');
                } else if (!ValidURL(person)) {
                    alert('Url không hợp lệ!');
                } else {
                    edt.insertHtml('{@embed: ' + person + '}');
                }
            }
        });
        editor.ui.addButton('SuperButton', {
            label: 'Online code',
            command: 'mySimpleCommand',
            toolbar: 'insert',
            icon: "{{ asset('plugins/ckeditor/skins/moono-lisa/code_link.png')}}",
        });
    }
    $(function () {
        $('body').addClass('home-page unified-theme');
        $('#textareaTag').tagEditor({
            delimiter: ', ',
            placeholder: '...',
            maxTags: {{ config('constants.MAX_TAG', 6) }},
            minTags: {{ config('constants.MIN_TAG', 2) }}
        });
    });
    editor.setData(`{!! $post->content !!}`);
</script>
@endsection
