@extends('home.master')

@section('title', __('user.userList'))
@section('link-header')
@endsection

@section('content')
<div id="mainbar-full ">
    <h1 class="fs-headline1 mb24">
        {{ __('page.user.list') }}
    </h1>
    <div class="grid fw-wrap">
        <div class="grid--cell mb12">
            {!! Form::open(['id' => 'login-form', 'route' => 'home.postLogin']) !!}
                {!! Form::text('userfilter', '', ['id' => 'userfilter', 'class' => 's-input', 'placeholder' => __('page.user.filter') . '...', 'autocomplete' => 'off']) !!}
            {!! Form::close() !!}
        </div>
        <div class="grid--cell ml-auto mb12 grid tabs-filter s-btn-group tt-capitalize">
            <a href="#" class="youarehere is-selected grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap" data-title="Users with the highest reputation scores">
                {{ __('page.user.reputation') }}
            </a>
            <a href="#" class="grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                {{ __('page.user.newUser') }}
            </a>
            <a href="#" class="grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap">
                {{ __('page.user.voter') }}
            </a>
        </div>
    </div>
    <div class="page-description mb12">
        <div class="grid jc-space-between">
            <div class="grid--cell ml-auto">
                <div id="tabs-interval" class="subtabs">
                    <a href="#" data-nav-xhref="" data-title="2000-01-01 to today">
                        {{ __('page.user.all') }}
                    </a>
                    <a href="#" data-nav-xhref="" data-title="2018-01-01 to today">
                        {{ __('page.user.year') }}
                    </a>
                    <a href="#" data-title="2018-10-01 to today">
                        {{ __('page.user.quarter') }}
                    </a>
                    <a href="#" data-nav-xhref="" data-title="2018-12-01 to today" data-value="month" data-shortcut="">
                        {{ __('page.user.month') }}
                    </a>
                    <a href="#" class="youarehere is-selected" data-title="2018-12-16 to today">
                        {{ __('page.user.week') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="user-browser">
        <div class="grid-layout">
            <div class="grid-layout--cell user-info  user-hover">
                <div class="user-gravatar48">
                    <a href="#">
                        <div class="gravatar-wrapper-48">
                            <img src="./Users - Stack Overflow_files/3aiJM.jpg" alt="" width="48" height="48">
                        </div>
                    </a>
                </div>
                <div class="user-details">
                    <a href="#">coldspeed</a>
                    <span class="user-location">Los Angeles, CA, United States</span>
                    <div class="-flair">
                        <span class="reputation-score" data-title="reputation this week: 1,094 total reputation: 115,906" dir="ltr">1,094</span>
                    </div>
                </div>
                <div class="user-tags">
                    <a href="#">python</a>, 
                    <a href="#">pandas</a>, 
                    <a href="#">dataframe</a>
                </div>
            </div>
        </div>
        <div class="pager fr">
            <span class="page-numbers current">1</span>         
            <a href="#" data-title="go to page 2"> 
                <span class="page-numbers">2</span> 
            </a> 
            <a href="#" data-title="go to page 3"> 
                <span class="page-numbers">3</span> 
            </a> 
            <a href="#" data-title="go to page 4"> 
                <span class="page-numbers">4</span> 
            </a> 
            <a href="#" data-title="go to page 5"> 
                <span class="page-numbers">5</span> 
            </a> 
            <span class="page-numbers dots">…</span>         
            <a href="#" data-title="go to page 262212"> 
                <span class="page-numbers">262212</span> 
            </a> 
            <a href="#" rel="next" data-title="go to page 2"> 
                <span class="page-numbers next"> {{ __('pagination.next') }}</span> 
            </a> 
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('body').addClass('users-page unified-theme');
</script>
@endsection
