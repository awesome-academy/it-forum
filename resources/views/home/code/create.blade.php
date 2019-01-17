@extends('home.code.master')

@section('content')
<div class="code-create-container">
    <h1>{{ __('page.code.create') }}</h1>
    <a href="{{ route('home.code.index') }}" class="btn btn-default">{{ __('page.code.home') }}</a>
    {!! Form::open(['class' => 'inline', 'route' => 'home.code.postCreate']) !!}
        {{ Form::hidden('isphp', 1) }}
        {!! Form::submit('php', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
    {!! Form::open(['class' => 'inline', 'route' => 'home.code.postCreate']) !!}
        {{ Form::hidden('isphp', 0) }}
        {!! Form::submit('html/css/js', ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
    <a href="{{ route('home.code.list') }}" class="btn btn-warning">{{ __('page.code.list') }}</a>
</div>
@endsection
