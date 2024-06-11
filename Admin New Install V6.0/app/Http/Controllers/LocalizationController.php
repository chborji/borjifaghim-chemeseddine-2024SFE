<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{

    /**
     * Checks whether the selected language is allowed and sets
     * the session variable 'locale with the selected language.
     *
     * @param String $lang
     * @return Illuminate\Http\Request
     */

    public function setLocalization($lang)
    {
        if (in_array($lang, app()->config->get('app.locale'))) {
            Session::put('locale', $lang);
        }
        return redirect()->back();
    }
}
