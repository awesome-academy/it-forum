@extends('admin.master')

@section('content')
<div class="card m-1">
    <div class="card-header">
        <div id="mainbar-full" class="post-show-new">
            <div class="subheader reloaded js-post-header" id="js-post-header1">
                @yield('tab')
            </div>
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
                @yield('detail-content')
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
                {!! Form::textarea('content', $post->content, ['id' => 'content', 'class' => 'form-control', 'placeholder' => '*', 'required']) !!}
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
