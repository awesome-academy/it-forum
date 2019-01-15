<?php

if (! function_exists('time_from_now')) {
    function time_from_now($date = '2018-12-25 02:35:06')
    {
        $locale = Session::get('website_language');
        $datetime = new Carbon\Carbon($date);
        $datetime->setLocale($locale);
        $now = $datetime->now();

        return $datetime->diffForHumans($now);
    }
}

if (! function_exists('image_upload_path')) {
    function image_upload_path($image = '')
    {
        return '/uploads/images/' . $image;
    }
}

if (! function_exists('getCurrentRouteName')) {
    function getCurrentRouteName()
    {
        return \Route::currentRouteName();
    }
}
