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
            <a class="btn btn-primary action" id="action" href="">{{ __('admin.edit') }}</a>
            <a class="btn btn-danger action" onclick="return confirm('{{ __('admin.alert.delete') }}')" href="" id="action">{{ __('admin.delete') }}</a>
        </td>
    </tr>
@endforeach
