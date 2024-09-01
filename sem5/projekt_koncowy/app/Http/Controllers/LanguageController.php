<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class LanguageController extends Controller
{
    public function changeLanguage($lang)
    {
        App::setLocale($lang);
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
