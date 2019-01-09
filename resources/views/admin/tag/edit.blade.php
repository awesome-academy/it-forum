@extends('admin.master')

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
                {{ __('admin.action.editTag') }}
            </h5>
        </div>
    </div>
    <div class="card-body form-validation">
        {!! Form::open(['class' => 'form-validation', 'route' => 'admin.tag.update', 'novalidate']) !!}
            {{ csrf_field() }}
            {!! Form::hidden('id', $tag->id, ['id' => 'id', 'class' => 'form-control']) !!}
            <div class="form-group">
                {!! Form::label('name', __('admin.form.name')) !!}
                {!! Form::text('name', $tag->name, ['id' => 'name', 'class' => 'form-control', 'placeholder' => '*', 'required']) !!}
            </div>
            <div class="form-group">
                <div class="form-check">
                    {!! Form::checkbox('status', '1', config('constants.CHECKBOX.' . $tag->status), ['id' => 'status', 'class' => 'form-check-input']) !!}
                    {!! Form::label('status', __('admin.active'), ['class' => 'form-check-label']) !!}
                </div>
            </div>
            {!! Form::submit(__('admin.action.editTag'), ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection
