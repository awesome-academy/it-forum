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
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Fullname</th>
                    <th>Phone</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td class="align-middle">{{ $user->id }}</td>
                        <td class="align-middle">{{ $user->username }}</td>
                        <td class="align-middle">{{ $user->email }}</td>
                        <td class="align-middle">{{ $user->fullname }}</td>
                        <td class="align-middle">{{ $user->phone }}</td>
                        <td class="align-middle">{{ date("d/m/Y", strtotime($user->birthday )) }}</td>
                        <td class="align-middle">{{ ($user->gender == 1) ? __('admin.male') : __('admin.female') }}</td>
                        <td class="align-middle">{{ $user->address }}</td>
                        <td class="align-middle">{{ ($user->role_id == 1) ? __('admin.admin') : __('admin.category.user') }}</td>
                        <td class="align-middle">{{ ($user->status == 1) ? __('admin.active') : __('admin.deactive') }}</td>
                        <td class="align-middle">
                            <a class="btn btn-primary action" id="action">{{ __('admin.edit') }}</a>
                            <a class="btn btn-danger action" id="action">{{ __('admin.delete') }}</a>
                        </td>
                    </tr>
                    @endforeach
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
