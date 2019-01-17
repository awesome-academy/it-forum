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
                {{ __('admin.action.editReport') }}
            </h5>
        </div>
    </div>
    <div class="card-body form-validation">
        {!! Form::open(['class' => 'form-validation', 'route' => 'admin.report.update', 'novalidate']) !!}
            {{ csrf_field() }}
            {!! Form::hidden('id', $report->id, ['id' => 'id', 'class' => 'form-control']) !!}
            <div class="form-row">
                <div class="form-group col-md-6">
                    {!! Form::label('email', __('admin.form.email')) !!}
                    {!! Form::text('email', $report->user->email, ['id' => 'email', 'class' => 'form-control disable', 'placeholder' => '*', 'required', 'readonly']) !!}
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('title', __('admin.category.post')) !!}
                    {!! Form::text('title', $report->post->title, ['id' => 'title', 'class' => 'form-control disable', 'placeholder' => '*', 'required', 'readonly']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('type', __('admin.form.type')) !!}
                {!! Form::text('type', __('admin.type.' . config('constants.REPORT_MESSAGES.' . $typeComment['0'])), ['id' => 'comment', 'class' => 'form-control disable', 'placeholder' => '*', 'required', 'readonly']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('comment', __('admin.form.comment')) !!}
                {!! Form::textarea('comment', $typeComment['1'], ['id' => 'comment', 'class' => 'form-control disable', 'placeholder' => '*', 'required', 'readonly']) !!}
            </div>
            <div class="form-group">
                <div class="form-check">
                    {!! Form::checkbox('status', '1', config('constants.CHECKBOX.' . $report->status), ['id' => 'status', 'class' => 'form-check-input']) !!}
                    {!! Form::label('status', __('admin.active'), ['class' => 'form-check-label']) !!}
                </div>
            </div>
            {!! Form::submit(__('admin.action.editReport'), ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection
