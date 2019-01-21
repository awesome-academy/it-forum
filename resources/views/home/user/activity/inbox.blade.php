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
<div id="main-content">
    <div id="profile-side" class="l-col-secondary">
        <div id="side-menu">
            <ul>
                <li class="category">
                    {{ __('page.user.activity') }}
                    <ul>
                        <li>
                            <a href="{{ route('home.user.activity', $id) }}">
                                {{ __('page.user.activity') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.user.answer', $id) }}">
                                {{ __('page.user.answer') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.user.inbox', $id) }}" class="youarehere">
                                {{ __('page.user.inbox') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.user.following', $id) }}">
                                {{ __('page.user.following') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.user.follower', $id) }}">
                                {{ __('page.user.follower') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.user.followingTag', $id) }}">
                                {{ __('page.user.followingTag') }}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div id="mainbar">
        <div class="topbar-dialog inbox-dialog" id="inbox-dialog-detail">
            <div class="modal-content">
                <ul>
                    @if (!empty($allNotifications))
                        @forelse ($allNotifications as $key => $value)
                            @php
                                $data = $value->data;
                            @endphp
                            <li class="inbox-item {{ empty($value->read_at) ? 'unread-item' : '' }}">
                                @if ($data['type'] == 'post')
                                <a href="{{ route('home.post.detail', [$data['target_id'], 'read' => $value->id]) }}" class="js-gps-track grid gs8 gsx">
                                @endif
                                <a href="{{ route('home.user.detail', [$data['target_id'], 'read' => $value->id]) }}" class="js-gps-track grid gs8 gsx">
                                    <div class="favicon favicon-stackoverflow site-icon grid--cell"></div>
                                    <div class="item-content grid--cell fl1">
                                        <div class="item-header">
                                            <span class="item-type">{!! __($data['title']) !!}</span>
                                            <span class="item-creation">
                                                <span class="relativetime">{{ time_from_now($value->created_at) }}</span>
                                            </span>
                                        </div>
                                        <div class="item-location">
                                            @if ($data['type'] == 'post')
                                                {!! __($data['content'], ['following' => $data['target_name'], 'post' => $data['post_name']]) !!}
                                            @elseif ($data['type'] == 'user')
                                                {!! __($data['content'], ['follower' => $data['target_name']]) !!}
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="inbox-item inbox-se-link">
                                <a class="d-block" href="">
                                    {{ __('page.notify.noneInbox') }}
                                </a>
                            </li>
                        @endforelse
                    @else
                        @include('home.layout.pagination', ['paginator' => $allNotifications])
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection