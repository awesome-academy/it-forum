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
