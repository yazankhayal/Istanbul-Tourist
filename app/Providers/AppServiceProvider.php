<?php

namespace App\Providers;

use App\Category;
use App\Contents;
use App\HPContactUS;
use App\Language;
use App\Partners;
use App\Post;
use App\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Closure;
use Cookie;
use Config;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
        Schema::defaultStringLength(191);
        view()->composer('*', function ($view) {

            $user = Auth::user();
            $langauges = Language::get();
            $setting = Setting::first();

            $pages_top = Post::where("type","2")->orderby('id','desc')->get();

            $hp_contact = HPContactUS::first();
            $geturlphoto = $setting->public;

            $select_lan = select_lan();
            $select_lan_choice = select_lan_choice();

            $lang = lang_app();

            $path = url('/').$geturlphoto;

            $view
                ->with('get_url_photo', $geturlphoto)
                ->with('path', $path)
                ->with('user', $user)
                ->with('lang', $lang)
                ->with('hp_contact', $hp_contact)
                ->with('pages_top', $pages_top)
                ->with('setting', $setting)
                ->with('select_lan_choice', $select_lan_choice)
                ->with('select_lan', $select_lan)
                ->with('langauges', $langauges);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
