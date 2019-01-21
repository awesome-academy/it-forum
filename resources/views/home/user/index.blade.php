@extends('home.master')

@section('title', __('admin.category.user'))

@section('link-header')
@endsection

@section('content')
<div id="list">
    <div id="mainbar-full">
        <h1 class="fs-headline1 mb24">
            {{ __('page.user.list') }}
        </h1>
        <div class="grid fw-wrap">
            <div class="grid--cell mb12">
                {!! Form::open(['id' => 'formFilter', 'data-route' => route('home.user.postIndex'), '@submit.prevent' => '']) !!}
                    {!! Form::text('username', '', ['id' => 'username', 'class' => 's-input', 'placeholder' => __('page.user.filter') . '...', 'autocomplete' => 'off', 'v-model' => 'username']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <div id="user-browser">
            <div class="grid-layout">
                <div class="grid-layout--cell user-info user-hover" v-for="user in allItems">
                    <div class="user-gravatar48">
                        <a href="#">
                            <div class="gravatar-wrapper-48">
                                <img :src="'/{{ config('constants.IMAGE_UPLOAD_PATH') }}' + user.image_path" class="gravatar">
                            </div>
                        </a>
                    </div>
                    <div class="user-details">
                        <a :href="'{{ route('home.user.detail') }}/' + user.id">@{{ user.username }}</a>
                        <span class="user-location">@{{ user.fullname }}</span>
                        <div class="-flair">
                            <span class="reputation-score" dir="ltr">1,094</span>
                        </div>
                    </div>
                    <div class="user-tags">
                        <a href="#">python</a>, 
                        <a href="#">pandas</a>, 
                        <a href="#">dataframe</a>
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
    $('body').addClass('users-page unified-theme');
</script>
@endsection
