<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangController extends Controller
{

    public function setLocale(Request $request, $locale)
    {
        App::setLocale($request->lang);
        session()->put('locale', $locale);

        return redirect()->back();
    }
}
