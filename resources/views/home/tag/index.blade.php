@extends('home.master')

@section('title', __('tag.tagList'))
@section('link-header')
@endsection

@section('content')
<div id="mainbar-full">
    <h1 class="fs-headline1 mb24">
        {{ __('page.tag.list') }}
    </h1>
    <p class="mb24">
        {{ __('page.tag.description') }}
    </p>
    <div class="grid mb24">
        <div class="grid--cell">
            {!! Form::open(['id' => 'login-form', 'route' => 'home.postLogin']) !!}
                {!! Form::text('tagfilter', '', ['id' => 'tagfilter', 'class' => 'f-input s-filter-input', 'placeholder' => __('page.tag.filter') . '...', 'maxlength' => 35]) !!}
            {!! Form::close() !!}
        </div>
        <div class="grid--cell ml-auto grid tabs-filter s-btn-group tt-capitalize">
            <a href="#" class="youarehere is-selected grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap" data-title="most popular tags">
                {{ __('page.tag.popular') }}
            </a>
            <a href="#" class="grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap" data-title="recently created tags">
                {{ __('page.tag.new') }}
            </a>
        </div>
    </div>
    <div id="tags_list">
        <div id="tags-browser" class="grid-layout">
            <div class="grid-layout--cell tag-cell">
                <a href="#" class="post-tag" data-title="" rel="tag">javascript</a>
                <span class="item-multiplier">
                    <span class="item-multiplier-x">×</span>&nbsp;
                    <span class="item-multiplier-count">1727673</span>
                </span>
                <div class="excerpt">
                    JavaScript (not to be confused with Java) is a high-level, dynamic, multi-paradigm, object-oriented, prototype-based, weakly-typed language used for both client-side and server-side scripting. Its pri…
                </div>
                <div class="grid jc-space-between">
                    <div class="grid--cell stats-row">
                        <a href="#" data-title="501 questions tagged javascript in the last 24 hours">
                            501 {{ __('page.tag.postedToday') }}
                        </a>, 
                        <a href="#" data-title="5033 questions tagged javascript in the last 7 days">
                            5033 {{ __('page.tag.thisWeek') }}
                        </a>
                    </div>
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
            <a href="#" data-title="go to page 1580"> 
                <span class="page-numbers">1580</span> 
            </a> 
            <a href="#" rel="next" data-title="go to page 2"> 
                <span class="page-numbers next">{{ __('pagination.next') }}</span> 
            </a> 
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('body').addClass('tags-page unified-theme')
</script>
@endsection
