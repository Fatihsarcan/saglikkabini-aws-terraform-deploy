<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        if (in_array($lang, array_keys(config('systemlang.locales')))) {
            // Session'a kaydet
            session()->put('locale', $lang);
            
            // Uygulama dilini anında değiştir
            App::setLocale($lang);
        }
        
        return redirect()->back();
    }
}