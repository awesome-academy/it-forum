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
            <a class="btn btn-primary action" id="action">{{ __('admin.edit') }}</a>
            <a class="btn btn-danger action" id="action">{{ __('admin.delete') }}</a>
        </td>
    </tr>
@endforeach
