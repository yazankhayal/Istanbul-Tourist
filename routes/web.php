<?php

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::group([ 'middleware' => 'xss'], function () {
    Route::post('/rating_services', 'HomepageController@rating_services')->name('rating_services');
    Route::post('/profile', 'HomepageController@profile')->name('profile');
});
Route::post('/newsletter', 'HomepageController@newsletter')->name('newsletter');

Route::get('/napster_yazan', 'HomepageController@napster_yazan')->name('napster_yazan');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'HomepageController@index')->name('index');
Route::get('/catalogue', 'HomepageController@catalogue')->name('catalogue');
Route::get('/services', 'HomepageController@services')->name('services');
Route::get('/blog', 'HomepageController@blog')->name('blog');

Route::get('/change_language/{lang?}', 'HomepageController@change_language')->name('change_language');

Route::get('/service/{id?}/{name?}', 'HomepageController@service')->name('service');
Route::get('/post/{id?}/{name?}', 'HomepageController@post')->name('post');


Route::get('/facebook', 'SocialiteController@redirectToFacebook')->name('facebook');
Route::get('/facebook/callback', 'SocialiteController@handleFacebookCallback');

Route::get('/google', 'SocialiteController@redirectToGoogle')->name('google');
Route::get('/google/callback', 'SocialiteController@handleGoogleCallback');
