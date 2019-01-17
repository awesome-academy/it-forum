@php
    $i = 0
@endphp
@foreach ($configs as $config)
    @php
        $i++
    @endphp
    <tr>
        <td class="align-middle">{{ $i }}</td>
        <td class="align-middle">{{ $config->name }}</td>
        <td class="align-middle">{{ $config->content }}</td>
        <td class="align-middle">{{ __('admin.' . config('constants.STATUS.' . $config->status)) }}</td>
        <td class="align-middle">
            <a class="btn btn-primary action" id="action" href="{{ route('admin.config.edit', ['id' => $config->id] ) }}">{{ __('admin.edit') }}</a>
            <a class="btn btn-danger action" onclick="return confirm('{{ __('admin.alert.delete') }}')" href="{{ route('admin.config.delete', ['id' => $config->id] ) }}" id="action">{{ __('admin.delete') }}</a>
        </td>
    </tr>
@endforeach
