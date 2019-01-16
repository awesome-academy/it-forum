@extends('admin.master')

@section('content')
<div class="card m-1">
    <div class="card-header">
        <div class="row">
            <div class='col-xs-12 col-sm-6 pt-sm-3 pt-md-2'>
                <h5>
                    <i class="fas fa-table"></i>
                    {{ __('admin.action.listReport') }}
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
                    <th>{{ __('admin.form.email') }}</th>
                    <th>{{ __('admin.category.post') }}</th>
                    <th>{{ __('admin.form.type') }}</th>
                    <th>{{ __('admin.form.comment') }}</th>
                    <th>{{ __('admin.form.status') }}</th>
                    <th>{{ __('admin.form.action') }}</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0
                    @endphp
                    @foreach ($reports as $report)
                        @php
                            $i++
                        @endphp
                        <tr>
                            <td class="align-middle">{{ $i }}</td>
                            <td class="align-middle">{{ $report->user->email }}</td>
                            <td class="align-middle"><a href="{{ route('home.post.detail', ['id' => $report->post->id]) }}" target="_blank">{{ $report->post->title }}</a></td>
                            <td class="align-middle">{{ __('admin.type.' . config('constants.REPORT_MESSAGES.' . $types[$i - 1])) }}</td>
                            <td class="align-middle">{{ $comments[$i - 1] }}</td>
                            <td class="align-middle">{{ __('admin.' . config('constants.STATUS.' . $report->status)) }}</td>
                            <td class="align-middle">
                                <a class="btn btn-primary action" id="action" href="{{ route('admin.report.edit', ['id' => $report->id] ) }}">{{ __('admin.edit') }}</a>
                                <a class="btn btn-danger action" onclick="return confirm('{{ __('admin.alert.delete') }}')" href="{{ route('admin.report.delete', ['id' => $report->id] ) }}" id="action">{{ __('admin.delete') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $reports->links() }}
        </div>
    </div>
</div>
@endsection
