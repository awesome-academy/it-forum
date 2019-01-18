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
        <td class="align-middle"><a href="{{ route('home.post.detail', ['id' => $post->id]) }}" target="_blank">{{ $post->title }}</a></td>
        <td class="align-middle"><div class="scrollable">{!! $post->content !!}</div></td>
        <td class="align-middle">{{ $tags[$i - 1] }}</td>
        <td class="align-middle">{{ $post->total_vote }}</td>
        <td class="align-middle">{{ $post->total_answer }}</td>
        <td class="align-middle">{{ $post->total_view }}</td>
        <td class="align-middle">{{ __('admin.' . config('constants.STATUS.' . $post->status)) }}</td>
        <td class="align-middle">
            <a class="btn btn-primary action" id="action" href="{{ route('admin.post.edit', ['id' => $post->id] ) }}">{{ __('admin.edit') }}</a>
            <a class="btn btn-danger action {{ config('constants.REPORT_DELETE_ADMIN.' . $reports[$i - 1]) }}" onclick="return confirm('{{ __('admin.alert.delete') }}')" href="{{ route('admin.post.delete', ['id' => $post->id] ) }}" id="action">{{ __('admin.delete') }}</a>
        </td>
    </tr>
@endforeach
