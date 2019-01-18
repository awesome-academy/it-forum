@extends('admin.master')

@section('content')
<div class="card m-1">
    <div class="card-header">
        <div class="row">
            <div class='col-xs-12 col-sm-6 pt-sm-3 pt-md-2'>
                <h5>
                    <i class="fas fa-table"></i>
                    {{ __('admin.action.listUser') }}
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
                    <th>{{ __('admin.form.email') }}</th>
                    <th>{{ __('admin.form.fullname') }}</th>
                    <th>{{ __('admin.form.phone') }}</th>
                    <th>{{ __('admin.form.birthday') }}</th>
                    <th>{{ __('admin.form.gender') }}</th>
                    <th>{{ __('admin.form.address') }}</th>
                    <th>{{ __('admin.form.role') }}</th>
                    <th>{{ __('admin.form.status') }}</th>
                    <th>{{ __('admin.form.action') }}</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0
                    @endphp
                    @foreach ($users as $user)
                        @php
                            $i++
                        @endphp
                        <tr>
                            <td class="align-middle">{{ $i }}</td>
                            <td class="align-middle">{{ $user->username }}</td>
                            <td class="align-middle">{{ $user->email }}</td>
                            <td class="align-middle">{{ $user->fullname }}</td>
                            <td class="align-middle">{{ $user->phone }}</td>
                            <td class="align-middle">{{ date('d/m/Y', strtotime($user->birthday )) }}</td>
                            <td class="align-middle">{{ __('admin.' . config('constants.GENDER.' . $user->gender)) }}</td>
                            <td class="align-middle">{{ $user->address }}</td>
                            <td class="align-middle">{{ __('admin.' . config('constants.ROLE.' . $user->role_id)) }}</td>
                            <td class="align-middle">{{ __('admin.' . config('constants.STATUS.' . $user->status)) }}</td>
                            <td class="align-middle">
                                <a class="btn btn-primary action" id="action" href="{{ route('admin.user.edit', ['id' => $user->id] ) }}">{{ __('admin.edit') }}</a>
                                <a class="btn btn-danger action {{ config('constants.USER_DETELE_ADMIN.' . $user->role_id) }}" onclick="return confirm('{{ __('admin.alert.delete') }}')" href="{{ route('admin.user.delete', ['id' => $user->id] ) }}" id="action">{{ __('admin.delete') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
