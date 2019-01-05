@extends('admin.master')

@section('content')
<div class="card m-1">
    <div class="card-header">
        <div class="row">
            <div class='col-xs-12 col-sm-6 pt-sm-3 pt-md-2'>
                <h5>
                    <i class="fas fa-table"></i>
                    {{ __('admin.action.listPost') }}
                </h5>
            </div>
            <div class='col-xs-12 col-sm-6'>
                <div class="d-flex justify-content-end form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                    <div class="input-group">
                        {!! Form::text('search', '', ['id' => 'search', 'placeholder' => __('admin.action.search'), 'class' => 'form-control', 'aria-label' => 'Search', 'aria-describedby' => 'basic-addon2']) !!}
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>{{ __('admin.form.id') }}</th>
                    <th>{{ __('admin.form.username') }}</th>
                    <th>{{ __('admin.form.title') }}</th>
                    <th>{{ __('admin.form.content') }}</th>
                    <th>{{ __('admin.form.total_vote') }}</th>
                    <th>{{ __('admin.form.total_answer') }}</th>
                    <th>{{ __('admin.form.total_view') }}</th>
                    <th>{{ __('admin.form.status') }}</th>
                    <th>{{ __('admin.form.action') }}</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0
                    @endphp
                    @foreach ($posts as $post)
                        @php
                            $i++
                        @endphp
                        <tr>
                            <td class="align-middle">{{ $i }}</td>
                            <td class="align-middle">{{ $post->user->username }}</td>
                            <td class="align-middle">{{ $post->title }}</td>
                            <td class="align-middle">{{ $post->content }}</td>
                            <td class="align-middle">{{ $post->total_vote }}</td>
                            <td class="align-middle">{{ $post->total_answer }}</td>
                            <td class="align-middle">{{ $post->total_view }}</td>
                            <td class="align-middle">{{ __('admin.' . config('constants.STATUS.' . $post->status)) }}</td>
                            <td class="align-middle">
                                <a class="btn btn-primary action" id="action" href="{{ route('admin.post.edit', ['id' => $post->id] ) }}">{{ __('admin.edit') }}</a>
                                <a class="btn btn-danger action" onclick="return confirm('{{ __('admin.alert.delete') }}')" href="{{ route('admin.post.delete', ['id' => $post->id] ) }}" id="action">{{ __('admin.delete') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
