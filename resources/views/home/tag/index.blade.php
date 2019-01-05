@extends('home.master')

@section('title', __('page.tag.list'))
@section('link-header')
@endsection

@section('content')
<div id="list">
    <div id="mainbar-full">
        <h1 class="fs-headline1 mb24">
            {{ __('page.tag.list') }}
        </h1>
        <p class="mb24">
            {{ __('page.tag.description') }}
        </p>
        <div class="grid mb24">
            <div class="grid--cell">
                    {!! Form::open(['id' => 'formFilter', 'data-route' => route('home.tag.postIndex')]) !!}
                        {!! Form::text('name', '', ['id' => 'username', 'class' => 's-input', 'placeholder' => __('page.tag.filter') . '...', 'autocomplete' => 'off', 'v-model' => 'name']) !!}
                    {!! Form::close() !!}
            </div>
            <div class="grid--cell ml-auto grid tabs-filter s-btn-group tt-capitalize">
                <a href="#" @click.prevent="isPopular = 1"
                    :class="[isPopular ? 'is-selected ' + classDefault : classDefault]">
                    {{ __('page.tag.popular') }}
                </a>
                <a href="#" @click.prevent="isPopular = 0"
                    :class="[!isPopular ? 'is-selected ' + classDefault : classDefault]">
                    {{ __('page.tag.new') }}
                </a>
            </div>
        </div>
        <div id="tags_list">
            <div id="tags-browser" class="grid-layout">
                <div class="grid-layout--cell tag-cell" v-for="tag in allItems">
                    <a :href="'{{ route('home.tag.index') }}/' + tag.name" class="post-tag" data-title="" rel="tag">@{{ tag.name }}</a>
                    <span class="item-multiplier">
                        <span class="item-multiplier-x">×</span>&nbsp;
                        <span class="item-multiplier-count">@{{ tag.posts_count }}</span>
                    </span>
                    <div class="excerpt">
                        @{{ tag.description }}
                    </div>
                    <div class="grid jc-space-between">
                        <div class="grid--cell stats-row">
                            <a href="#" data-title="501 questions tagged javascript in the last 24 hours">
                                @{{ tag.posts_count * 123 }} {{ __('page.tag.postedToday') }}
                            </a>, 
                            <a href="#" data-title="5033 questions tagged javascript in the last 7 days">
                                @{{ tag.posts_count * 2341 }} {{ __('page.tag.thisWeek') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pager fr" v-if="pagination.total != 0">
                <a href="#" @click.prevent="changePage(pagination.current_page - 1)">
                    <span class="page-numbers">{{ __('pagination.previous') }}</span>
                </a>
                <a href="#" v-for="page in pagesNumber" @click.prevent="changePage(page)">
                    <span :class="[ page == isActived ? 'page-numbers current' : 'page-numbers']">@{{ page }}</span>
                </a>
                <a href="#" @click.prevent="changePage(pagination.current_page + 1)">
                    <span class="page-numbers">{{ __('pagination.next') }}</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('body').addClass('tags-page unified-theme')
</script>
@endsection
