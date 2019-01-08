<?php

namespace App\Http\Controllers;

class LanguageController extends Controller
{
    /**
    * change language controller
    * Author: Lampham
    */
    public function changeLanguage($language)
    {
        \Session::put('website_language', $language);
        
        return redirect()->back();
    }
}
