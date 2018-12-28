@extends('home.user.master')

@section('tab')
<div id="tabs">
	<a href="{{ route('home.user.detail', $id) }}" data-shortcut="P">
	    {{ __('page.user.profile') }}
	</a>
	<a href="{{ route('home.user.activity', $id) }}" class="youarehere" data-shortcut="A">
	    {{ __('page.user.activity') }}
	</a>
</div>
<div class="additional-links">
    <a href="{{ route('home.logout') }}">
        {{ __('page.user.logout') }}
    </a>
</div>
@endsection

@section('detail-content')
@endsection
