@extends('home.master')

@section('title', 'Phạm Tùng Lâm')
@section('link-header')
@endsection

@section('content')
@include('home.user.temp')
@endsection

@section('rightbar')
@endsection

@section('js')
<script>
    $('body').addClass('users-page unified-theme');
</script>
@endsection
