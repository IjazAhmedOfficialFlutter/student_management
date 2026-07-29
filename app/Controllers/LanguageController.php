<?php

namespace App\Controllers;

class LanguageController extends BaseController
{
   public function change(string $locale)
{
    $supported = config('App')->supportedLocales;

    if (in_array($locale, $supported, true)) {
        session()->set('locale', $locale);
    }

    return redirect()->back();
}
}