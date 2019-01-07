@extends('admin.master')

@section('content')
<div class="card m-1">
    <div class="card-header">
        <div class="row">
            <div class='col-xs-12 col-sm-6 pt-sm-3 pt-md-2'>
                <h5>
                    <i class="fas fa-table"></i>
                    {{ __('admin.action.listTag') }}
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
                    <th>{{ __('admin.form.name') }}</th>
                    <th>{{ __('admin.category.post') }}</th>
                    <th>{{ __('admin.form.status') }}</th>
                    <th>{{ __('admin.form.action') }}</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0
                    @endphp
                    @foreach ($tags as $tag)
                        @php
                            $i++
                        @endphp
                        <tr>
                            <td class="align-middle">{{ $i }}</td>
                            <td class="align-middle">{{ $tag->name }}</td>
                            <td class="align-middle">{{ $tag->posts->count() }}</td>
                            <td class="align-middle">{{ __('admin.' . config('constants.STATUS.' . $tag->status)) }}</td>
                            <td class="align-middle">
                                <a class="btn btn-primary action" id="action" href="{{ route('admin.tag.edit', ['id' => $tag->id] ) }}">{{ __('admin.edit') }}</a>
                                <a class="btn btn-danger action" onclick="return confirm('{{ __('admin.alert.delete') }}')" href="{{ route('admin.tag.delete', ['id' => $tag->id] ) }}" id="action">{{ __('admin.delete') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $tags->links() }}
        </div>
    </div>
</div>
@endsection
