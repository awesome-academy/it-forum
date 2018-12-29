@extends('admin.master')

@section('content')
<div class="card m-1">
    <div class="card-header">
        <i class="fas fa-table"></i>
        {{ __('admin.action.listUser') }}
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
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>$320,800</td>
                <td>$320,800</td>
                <td>$320,800</td>
                <td>$320,800</td>
                <td>$320,800</td>
            </tr>
        </table>
        </div>
    </div>
    </div>
</div>
@endsection
