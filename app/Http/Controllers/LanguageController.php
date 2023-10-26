<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLocale($locale)
    {
        app()->setLocale($locale);
        dd(app()->getLocale());
        return back();
    }
}