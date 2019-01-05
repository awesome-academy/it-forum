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
            <a class="btn btn-primary action" id="action" href="{{ route('admin.user.edit', ['id' => $post->id] ) }}">{{ __('admin.edit') }}</a>
            <a class="btn btn-danger action" onclick="return confirm('{{ __('admin.alert.delete') }}')" href="{{ route('admin.user.delete', ['id' => $post->id] ) }}" id="action">{{ __('admin.delete') }}</a>
        </td>
    </tr>
@endforeach
