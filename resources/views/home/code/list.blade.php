@extends('home.code.master')

@section('content')
<h1>{{ __('page.code.list') }}:</h1>
@if (!empty($codes))
    <ol>
    @foreach ($codes as $key => $c)
        <li>
            <a href="{{ route('home.code.show', $c->codename) }}">{{ $c->codename }}</a>
            <button href="{{ route('home.code.show', $c->codename) }}" class="btn btn-sm btn-default showEmbedded"></button>
            <a class="hidden linkEmbed{{ $key }}" href="{{ route('home.code.embedded', $c->codename) }}">{{ route('home.code.embedded', $c->codename) }}</a>
            <span>{{ (!empty($c->isphp)) ? '(php)' : '' }}</span>
        </li> 
    @endforeach
    <p><a href="{{ route('home.code.create') }}" class="btn btn-default">{{ __('page.code.back') }}</a></p>
    </ol>
@endif
@endsection

@section('js')
<script>
    $('.showEmbedded').click(function() {
        $(this).next().toggleClass('hidden');
    });
</script>
@endsection
