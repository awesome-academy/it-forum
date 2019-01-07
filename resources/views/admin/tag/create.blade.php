@extends('admin.master')

@section('content')
<div class="card m-1">
    <div class="card-header">
        <div id="mainbar-full" class="user-show-new">
            <div class="subheader reloaded js-user-header" id="js-user-header1">
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
                {{ __('admin.action.addTag') }}
            </h5>
        </div>

    </div>
    <div class="card-body form-validation">
        {!! Form::open(['class' => 'form-validation', 'route' => 'admin.tag.add', 'novalidate']) !!}
            {{ csrf_field() }}
            <div class="form-group">
                {!! Form::label('name', __('admin.form.name')) !!}
                {!! Form::text('name', '', ['id' => 'name', 'class' => 'form-control', 'placeholder' => '*', 'required']) !!}
            </div>
            <div class="form-group">
                <div class="form-check">
                    {!! Form::checkbox('status', '1', true, ['id' => 'status', 'class' => 'form-check-input']) !!}
                    {!! Form::label('status', __('admin.active'), ['class' => 'form-check-label']) !!}
                </div>
            </div>
            {!! Form::submit(__('admin.action.addTag'), ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection
