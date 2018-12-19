<html>
<a href="{{ route('language.change', 'vi') }}">Vie</a>
<a href="{{ route('language.change', 'en') }}">Eng</a>

<p>{{ Session::get('website_language') }}</p>
<p>{{ __('post.name') }}</p>
</html>
