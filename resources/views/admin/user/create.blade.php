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
                {{ __('admin.action.addUser') }}
            </h5>
        </div>
    </div>
    <div class="card-body form-validation">
        {!! Form::open(['class' => 'form-validation', 'route' => 'admin.user.add', 'novalidate']) !!}
            {{ csrf_field() }}
            <div class="form-row">
                <div class="form-group col-md-6">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', '', ['id' => 'email', 'class' => 'form-control', 'placeholder' => '*', 'required']) !!}
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('fullname', __('admin.form.fullname')) !!}
                    {!! Form::text('fullname', '', ['id' => 'fullname', 'class' => 'form-control', 'placeholder' => '*', 'required']) !!}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    {!! Form::label('username', __('admin.form.username')) !!}
                    {!! Form::text('username', '', ['id' => 'username', 'class' => 'form-control', 'placeholder' => '*', 'required']) !!}
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('password', __('admin.form.password')) !!}
                    {!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => '*', 'required']) !!}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    {!! Form::label('phone', __('admin.form.phone')) !!}
                    {!! Form::text('phone', '', ['id' => 'phone', 'class' => 'form-control', 'placeholder' => '*', 'required']) !!}
                </div>
                <div class="form-group col-md-3">
                    {!! Form::label('birthday', __('admin.form.birthday')) !!}
                    {!! Form::text('birthday', '', ['id' => 'birthday', 'class' => 'form-control', 'placeholder' => '*', 'required', 'autocomplete' => 'off']) !!}
                </div>
                <div class="form-group col-md-3">
                    {!! Form::label('gender', __('admin.form.gender')) !!}
                    {!! Form::select('gender', ['1' => __('admin.male'), '2' => __('admin.female')], '1', ['id' => 'gender', 'class' => 'form-control'])!!}
                </div>
                <div class="form-group col-md-3">
                    {!! Form::label('role_id', __('admin.form.role')) !!}
                    {!! Form::select('role_id', ['2' => __('admin.category.user'), '1' => __('admin.admin')], '2', ['id' => 'role_id', 'class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('address', __('admin.form.address')) !!}
                {!! Form::text('address', '', ['id' => 'address', 'class' => 'form-control', 'placeholder' => '*', 'required']) !!}
            </div>
            <div class="form-group">
                <div class="form-check">
                    {!! Form::checkbox('status', '1', true, ['id' => 'status', 'class' => 'form-check-input']) !!}
                    {!! Form::label('status', __('admin.active'), ['class' => 'form-check-label']) !!}
                </div>
            </div>
            {!! Form::submit(__('admin.action.addUser'), ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('script')
    @include('admin.layout.datepicker-script')
@endsection
