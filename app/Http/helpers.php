<?php

function CurrentLangShow($lang_s)
{
    $select_lan = \App\Language::where('dir', '=', app()->getLocale())->first();
    $data_results = file_get_contents(public_path() . '/languages/' . $select_lan->dir . '.json');
    $lang = json_decode($data_results);
    foreach ($lang as $key => $value) {
        if ($key == $lang_s) {
            return $value;
        }
    }
}

function lang_name_dashbaord($lang_s)
{
    $select_lan = \App\Language::where('dir', '=', app()->getLocale())->first();
    $data_results = file_get_contents(public_path() . '/languages/' . $select_lan->dir . '_dashboard.json');
    $lang = json_decode($data_results);
    foreach ($lang as $key => $value) {
        if ($key == $lang_s) {
            return $value;
        }
    }
}

if (!function_exists('ul_link')) {
    function ul_link($link)
    {
        $one = route($link);
        return $one;
    }
}

if (!function_exists('getLocale')) {
    function getLocale()
    {
        $one = app()->getLocale();
        return $one;
    }
}

if (!function_exists('select_lan')) {
    function select_lan()
    {

        $select_lan = \App\Language::where('dir', '=', app()->getLocale())->first();
        if ($select_lan == null) {
            $select_lan = \App\Language::where('select', '=', '1')->first();
        }
        return $select_lan;
    }
}

if (!function_exists('select_lan_choice')) {
    function select_lan_choice()
    {
        $select_lan_choice = \App\Language::where('select', '=', '1')->first();
        return $select_lan_choice;
    }
}

if (!function_exists('save_lang')) {
    function save_lang()
    {
        $select_lan_choice = \Cookie::get('save_lang');
        return $select_lan_choice;
    }
}

if (!function_exists('lang_app')) {
    function lang_app()
    {
        $count_header = count(Request::segments(1));
        if ($count_header == 0) {
            $data_results = file_get_contents(public_path() . '/languages/' . select_lan()->dir . '.json');
        }
        else {
            $secound_url = Request::segments(1)[0];
            if($secound_url == "dashboard" || $secound_url == "editor" || $secound_url == "support"){
                $data_results = file_get_contents(public_path() . '/languages/' . select_lan()->dir . '_dashboard.json');
            }
            else{
                $data_results = file_get_contents(public_path() . '/languages/' . select_lan()->dir . '.json');
            }
        }
        $lang = json_decode($data_results);
        return $lang;
    }
}

if (!function_exists('dis')) {
    function dis()
    {
        $count = count(Request::segments(1));
        $dis = "disabled";
        if ($count == 4) {
            if (Request::segments(1)[3]) {
                $dis = "";
            }
        }
        return $dis;
    }
}

if (!function_exists('lang_name')) {
    function lang_name($lang)
    {
        $two = CurrentLangShow($lang);
        if ($two) {
            return $two;
        } else {
            return 'No_found_language : ' . $lang;
        }
    }
}

if (!function_exists('current_route')) {
    function current_route($x)
    {
        if (\Route::current()->getName() == $x) {
            return "active";
        } else {
            return "";
        }
    }
}

if (!function_exists('category')) {
    function category()
    {
        $category = \App\Category::get();
        return $category;
    }
}


if (!function_exists('catalogue')) {
    function catalogue()
    {
        $category = \App\Catalogue::get();
        return $category;
    }
}

if (!function_exists('city')) {
    function city()
    {
        $category = \App\City::get();
        return $category;
    }
}

if (!function_exists('services_featured')) {
    function services_featured()
    {
        $i = \App\Services::where("featured", "1")->get();
        return $i;
    }
}

if (!function_exists('pages_header')) {
    function pages_header()
    {
        $i = \App\Post::where("type", "2")->orderby('sort','asc')->where("featured", "1")->get();
        return $i;
    }
}

if (!function_exists('pages_footer')) {
    function pages_footer()
    {
        $i = \App\Post::where("type", "3")->orderby('sort','asc')->where("featured", "1")->get();
        return $i;
    }
}

if (!function_exists('pages_footer1')) {
    function pages_footer1()
    {
        $i = \App\Post::where("type", "4")->orderby('sort','asc')->where("featured", "1")->get();
        return $i;
    }
}

if (!function_exists('setting')) {
    function setting()
    {
        $setting = \App\Setting::first();
        return $setting;
    }
}

if (!function_exists('hp_contact')) {
    function hp_contact()
    {
        $setting = \App\HPContactUS::first();
        return $setting;
    }
}

if (!function_exists('path')) {
    function path()
    {
        $path = \App\Setting::first()->public;
        $ps = url('/') . $path;
        return $ps;
    }
}

if (!function_exists('get_url_photo')) {
    function get_url_photo()
    {
        $path = \App\Setting::first()->public;
        return $path;
    }
}

if (!function_exists('scripts')) {
    function scripts()
    {
        $items = \App\ScriptsSetting::first();
        return $items;
    }
}

if (!function_exists('adv_block')) {
    function adv_block()
    {
        $items = \App\AdvBlock::first();
        return $items;
    }
}


if (!function_exists('email_setting')) {
    function email_setting()
    {
        $items = \App\EmailSetting::first();
        return $items;
    }
}
