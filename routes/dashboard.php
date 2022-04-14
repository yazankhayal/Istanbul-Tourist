<?php
/**
 * Created by PhpStorm.
 * User: Napster
 * Date: 6/2/2020
 * Time: 1:13 PM
 */

// Dashboard
Route::group(['prefix' => 'dashboard', 'middleware' => 'dashboard'], function () {

    Route::get('/', 'Dashboard\DashboardController@index')->name('dashboard_admin.index');

    Route::get('/dashboard/languages', 'Dashboard\DashboardController@languages')->name('dashboard_admin.languages');
    Route::get('/dashboard/languages_exption_em', 'Dashboard\DashboardController@languages_exption_em')->name('dashboard_admin.languages_exption_em');
    Route::get('/dashboard/currencies_dolar', 'Dashboard\DashboardController@currencies_dolar')->name('dashboard_admin.currencies_dolar');

    Route::get('/send_email', 'Dashboard\DashboardController@send_email')->name('dashboard_send_email.index');
    Route::post('/send_email_send', 'Dashboard\DashboardController@send_email_send')->name('dashboard_send_email.send');

    // Dashboard users
    Route::group(['prefix' => '/users'], function () {
        Route::get('', 'Dashboard\UsersController@index')->name('dashboard_users.index');
        Route::get('/add_edit/{id?}', 'Dashboard\UsersController@add_edit')->name('dashboard_users.add_edit');
        Route::get('/get_data_by_id', 'Dashboard\UsersController@get_data_by_id')->name('dashboard_users.get_data_by_id');
        Route::get('/deleted', 'Dashboard\UsersController@deleted')->name('dashboard_users.deleted');
        Route::post('/get_data', 'Dashboard\UsersController@get_data')->name('dashboard_users.get_data');
        Route::post('/post_data', 'Dashboard\UsersController@post_data')->name('dashboard_users.post_data');
        Route::post('/post_data_subscription', 'Dashboard\UsersController@post_data_subscription')->name('dashboard_users.post_data_subscription');
        Route::get('/confirm_email', 'Dashboard\UsersController@confirm_email')->name('dashboard_users.confirm_email');
        Route::get('/suspended', 'Dashboard\UsersController@suspended')->name('dashboard_users.suspended');
    });

    // Dashboard language
    Route::group(['prefix' => '/language'], function () {
        Route::get('', 'Dashboard\LanguageController@index')->name('dashboard_language.index');
        Route::get('/lang/{id?}', 'Dashboard\LanguageController@lang')->name('dashboard_language.lang');
        Route::post('/lang_post', 'Dashboard\LanguageController@lang_post')->name('dashboard_language.lang_post');
        Route::get('/add_edit/{id?}', 'Dashboard\LanguageController@add_edit')->name('dashboard_language.add_edit');
        Route::get('/get_data_by_id', 'Dashboard\LanguageController@get_data_by_id')->name('dashboard_language.get_data_by_id');
        Route::get('/deleted', 'Dashboard\LanguageController@deleted')->name('dashboard_language.deleted');
        Route::post('/get_data', 'Dashboard\LanguageController@get_data')->name('dashboard_language.get_data');
        Route::post('/post_data', 'Dashboard\LanguageController@post_data')->name('dashboard_language.post_data');
    });

    // Dashboard setting
    Route::group(['prefix' => '/setting'], function () {
        Route::get('', 'Dashboard\SettingController@index')->name('dashboard_setting.index');
        Route::post('/post_data', 'Dashboard\SettingController@post_data')->name('dashboard_setting.post_data');
        Route::get('/get_data_by_id', 'Dashboard\SettingController@get_data_by_id')->name('dashboard_setting.get_data_by_id');
    });

    // Dashboard setting_translate
    Route::group(['prefix' => '/setting_translate'], function () {
        Route::post('/post_data', 'Dashboard\SettingTranslateController@post_data')->name('dashboard_setting_translate.post_data');
        Route::get('/get_data', 'Dashboard\SettingTranslateController@get_data_by_id')->name('dashboard_setting_translate.get_data_by_id');
    });

    // Dashboard posts
    Route::group(['prefix' => '/posts'], function () {
        Route::get('', 'Dashboard\PostsController@index')->name('dashboard_posts.index');
        Route::get('/add_edit/{id?}', 'Dashboard\PostsController@add_edit')->name('dashboard_posts.add_edit');
        Route::get('/get_data_by_id', 'Dashboard\PostsController@get_data_by_id')->name('dashboard_posts.get_data_by_id');
        Route::get('/deleted', 'Dashboard\PostsController@deleted')->name('dashboard_posts.deleted');
        Route::post('/get_data', 'Dashboard\PostsController@get_data')->name('dashboard_posts.get_data');
        Route::post('/post_data', 'Dashboard\PostsController@post_data')->name('dashboard_posts.post_data');
        Route::get('/featured', 'Dashboard\PostsController@featured')->name('dashboard_posts.featured');
        Route::get('/sort', 'Dashboard\PostsController@sort')->name('dashboard_posts.sort');
    });

    // Dashboard posts_translate
    Route::group(['prefix' => '/posts_translate'], function () {
        Route::post('/post_data', 'Dashboard\PostsTranslateController@post_data')->name('dashboard_posts_translate.post_data');
        Route::get('/get_data', 'Dashboard\PostsTranslateController@get_data_by_id')->name('dashboard_posts_translate.get_data_by_id');
    });

    // Dashboard category
    Route::group(['prefix' => '/category'], function () {
        Route::get('', 'Dashboard\CategoryController@index')->name('dashboard_category.index');
        Route::get('/add_edit/{id?}', 'Dashboard\CategoryController@add_edit')->name('dashboard_category.add_edit');
        Route::get('/get_data_by_id', 'Dashboard\CategoryController@get_data_by_id')->name('dashboard_category.get_data_by_id');
        Route::get('/deleted', 'Dashboard\CategoryController@deleted')->name('dashboard_category.deleted');
        Route::post('/get_data', 'Dashboard\CategoryController@get_data')->name('dashboard_category.get_data');
        Route::post('/post_data', 'Dashboard\CategoryController@post_data')->name('dashboard_category.post_data');
        Route::get('/featured', 'Dashboard\CategoryController@featured')->name('dashboard_category.featured');
        Route::get('/trending', 'Dashboard\CategoryController@trending')->name('dashboard_category.trending');
    });

    // Dashboard category_translate
    Route::group(['prefix' => '/category_translate'], function () {
        Route::post('/post_data', 'Dashboard\CategoryTranslateController@post_data')->name('dashboard_category_translate.post_data');
        Route::get('/get_data', 'Dashboard\CategoryTranslateController@get_data_by_id')->name('dashboard_category_translate.get_data_by_id');
    });
    // Dashboard services
    Route::group(['prefix' => '/services'], function () {
        Route::get('', 'Dashboard\ServicesController@index')->name('dashboard_services.index');
        Route::get('/add_edit/{id?}', 'Dashboard\ServicesController@add_edit')->name('dashboard_services.add_edit');
        Route::get('/get_data_by_id', 'Dashboard\ServicesController@get_data_by_id')->name('dashboard_services.get_data_by_id');
        Route::get('/deleted', 'Dashboard\ServicesController@deleted')->name('dashboard_services.deleted');
        Route::post('/get_data', 'Dashboard\ServicesController@get_data')->name('dashboard_services.get_data');
        Route::post('/post_data', 'Dashboard\ServicesController@post_data')->name('dashboard_services.post_data');

        Route::get('/home_1', 'Dashboard\ServicesController@home_1')->name('dashboard_services.home_1');
        Route::get('/home_2', 'Dashboard\ServicesController@home_2')->name('dashboard_services.home_2');

        Route::post('/uploadjquery', 'Dashboard\ServicesController@uploadjquery')->name('dashboard_services.uploadjquery');
        Route::get('/deleteuploadjquery', 'Dashboard\ServicesController@deleteuploadjquery')->name('dashboard_services.deleteuploadjquery');

    });

    // Dashboard services_translate
    Route::group(['prefix' => '/services_translate'], function () {
        Route::post('/post_data', 'Dashboard\ServicesTranslateController@post_data')->name('dashboard_services_translate.post_data');
        Route::get('/get_data', 'Dashboard\ServicesTranslateController@get_data_by_id')->name('dashboard_services_translate.get_data_by_id');
    });

    // Dashboard testimonials
    Route::group(['prefix' => '/testimonials'], function () {
        Route::get('', 'Dashboard\TestimonialsController@index')->name('dashboard_testimonials.index');
        Route::get('/add_edit/{id?}', 'Dashboard\TestimonialsController@add_edit')->name('dashboard_testimonials.add_edit');
        Route::get('/get_data_by_id', 'Dashboard\TestimonialsController@get_data_by_id')->name('dashboard_testimonials.get_data_by_id');
        Route::get('/deleted', 'Dashboard\TestimonialsController@deleted')->name('dashboard_testimonials.deleted');
        Route::post('/get_data', 'Dashboard\TestimonialsController@get_data')->name('dashboard_testimonials.get_data');
        Route::post('/post_data', 'Dashboard\TestimonialsController@post_data')->name('dashboard_testimonials.post_data');
    });

    // Dashboard testimonials_translate
    Route::group(['prefix' => '/testimonials_translate'], function () {
        Route::post('/post_data', 'Dashboard\TestimonialsTranslateController@post_data')->name('dashboard_testimonials_translate.post_data');
        Route::get('/get_data', 'Dashboard\TestimonialsTranslateController@get_data_by_id')->name('dashboard_testimonials_translate.get_data_by_id');
    });

    // Dashboard newsletter
    Route::group(['prefix' => '/newsletter'], function () {
        Route::get('', 'Dashboard\NewsletterController@index')->name('dashboard_newsletter.index');
        Route::get('/deleted', 'Dashboard\NewsletterController@deleted')->name('dashboard_newsletter.deleted');
        Route::post('/get_data', 'Dashboard\NewsletterController@get_data')->name('dashboard_newsletter.get_data');
    });

    // Dashboard hp_contact_us
    Route::group(['prefix' => '/hp_contact_us'], function () {
        Route::get('', 'Dashboard\HPContactUSController@index')->name('dashboard_hp_contact_us.index');
        Route::post('/post_data', 'Dashboard\HPContactUSController@post_data')->name('dashboard_hp_contact_us.post_data');
        Route::get('/get_data_by_id', 'Dashboard\HPContactUSController@get_data_by_id')->name('dashboard_hp_contact_us.get_data_by_id');
    });

    Route::group(['prefix' => '/address'], function () {
        Route::get('', 'Dashboard\AddressController@index')->name('dashboard_address.index');
        Route::get('/add_edit/{id?}', 'Dashboard\AddressController@add_edit')->name('dashboard_address.add_edit');
        Route::get('/get_data_by_id', 'Dashboard\AddressController@get_data_by_id')->name('dashboard_address.get_data_by_id');
        Route::get('/deleted', 'Dashboard\AddressController@deleted')->name('dashboard_address.deleted');
        Route::post('/get_data', 'Dashboard\AddressController@get_data')->name('dashboard_address.get_data');
        Route::post('/post_data', 'Dashboard\AddressController@post_data')->name('dashboard_address.post_data');
    });

    // Dashboard address_translate
    Route::group(['prefix' => '/address_translate'], function () {
        Route::post('/post_data', 'Dashboard\AddressTranslateController@post_data')->name('dashboard_address_translate.post_data');
        Route::get('/get_data', 'Dashboard\AddressTranslateController@get_data_by_id')->name('dashboard_address_translate.get_data_by_id');
    });

    // Dashboard about
    Route::group(['prefix' => '/about'], function () {
        Route::get('', 'Dashboard\AboutController@index')->name('dashboard_about.index');
        Route::post('/post_data', 'Dashboard\AboutController@post_data')->name('dashboard_about.post_data');
        Route::get('/get_data_by_id', 'Dashboard\AboutController@get_data_by_id')->name('dashboard_about.get_data_by_id');
    });

    // Dashboard about_translate
    Route::group(['prefix' => '/about_translate'], function () {
        Route::post('/post_data', 'Dashboard\AboutTranslateController@post_data')->name('dashboard_about_translate.post_data');
        Route::get('/get_data', 'Dashboard\AboutTranslateController@get_data_by_id')->name('dashboard_about_translate.get_data_by_id');
    });

    // Dashboard Banner
    Route::group(['prefix' => '/banner'], function () {
        Route::get('', 'Dashboard\About2Controller@index')->name('dashboard_about_page.index');
        Route::post('/post_data', 'Dashboard\About2Controller@post_data')->name('dashboard_about_page.post_data');
        Route::get('/get_data_by_id', 'Dashboard\About2Controller@get_data_by_id')->name('dashboard_about_page.get_data_by_id');
    });

    // Dashboard video_translate
    Route::group(['prefix' => '/banner_translate'], function () {
        Route::post('/post_data', 'Dashboard\About2TranslateController@post_data')->name('dashboard_about_page_translate.post_data');
        Route::get('/get_data', 'Dashboard\About2TranslateController@get_data_by_id')->name('dashboard_about_page_translate.get_data_by_id');
    });

    // Dashboard about_page
    Route::group(['prefix' => '/about_page'], function () {
        Route::get('', 'Dashboard\AboutPageController@index')->name('dashboard_about_page_2.index');
        Route::post('/post_data', 'Dashboard\AboutPageController@post_data')->name('dashboard_about_page_2.post_data');
        Route::get('/get_data_by_id', 'Dashboard\AboutPageController@get_data_by_id')->name('dashboard_about_page_2.get_data_by_id');
    });

    // Dashboard about_page_translate
    Route::group(['prefix' => '/about_page_translate'], function () {
        Route::post('/post_data', 'Dashboard\AboutPageTranslateController@post_data')->name('dashboard_about_page_2_translate.post_data');
        Route::get('/get_data', 'Dashboard\AboutPageTranslateController@get_data_by_id')->name('dashboard_about_page_2_translate.get_data_by_id');
    });

    // Dashboard catalogue
    Route::group(['prefix' => '/catalogue'], function () {
        Route::get('', 'Dashboard\CatalogueController@index')->name('dashboard_catalogue.index');
        Route::get('/add_edit/{id?}', 'Dashboard\CatalogueController@add_edit')->name('dashboard_catalogue.add_edit');
        Route::get('/get_data_by_id', 'Dashboard\CatalogueController@get_data_by_id')->name('dashboard_catalogue.get_data_by_id');
        Route::get('/deleted', 'Dashboard\CatalogueController@deleted')->name('dashboard_catalogue.deleted');
        Route::post('/get_data', 'Dashboard\CatalogueController@get_data')->name('dashboard_catalogue.get_data');
        Route::post('/post_data', 'Dashboard\CatalogueController@post_data')->name('dashboard_catalogue.post_data');
    });

    // Dashboard catalogue_translate
    Route::group(['prefix' => '/catalogue_translate'], function () {
        Route::post('/post_data', 'Dashboard\CatalogueTranslateController@post_data')->name('dashboard_catalogue_translate.post_data');
        Route::get('/get_data', 'Dashboard\CatalogueTranslateController@get_data_by_id')->name('dashboard_catalogue_translate.get_data_by_id');
    });

    // Dashboard city
    Route::group(['prefix' => '/city'], function () {
        Route::get('', 'Dashboard\CityController@index')->name('dashboard_city.index');
        Route::get('/add_edit/{id?}', 'Dashboard\CityController@add_edit')->name('dashboard_city.add_edit');
        Route::get('/get_data_by_id', 'Dashboard\CityController@get_data_by_id')->name('dashboard_city.get_data_by_id');
        Route::get('/deleted', 'Dashboard\CityController@deleted')->name('dashboard_city.deleted');
        Route::post('/get_data', 'Dashboard\CityController@get_data')->name('dashboard_city.get_data');
        Route::post('/post_data', 'Dashboard\CityController@post_data')->name('dashboard_city.post_data');
    });

    // Dashboard city_translate
    Route::group(['prefix' => '/city_translate'], function () {
        Route::post('/post_data', 'Dashboard\CityTranslateController@post_data')->name('dashboard_city_translate.post_data');
        Route::get('/get_data', 'Dashboard\CityTranslateController@get_data_by_id')->name('dashboard_city_translate.get_data_by_id');
    });

    // Dashboard email_setting
    Route::group(['prefix' => '/email_setting'], function () {
        Route::get('', 'Dashboard\EmailSettingController@index')->name('dashboard_email_setting.index');
        Route::post('/post_data', 'Dashboard\EmailSettingController@post_data')->name('dashboard_email_setting.post_data');
        Route::get('/get_data_by_id', 'Dashboard\EmailSettingController@get_data_by_id')->name('dashboard_email_setting.get_data_by_id');
    });

    // Dashboard scripts
    Route::group(['prefix' => '/scripts'], function () {
        Route::get('', 'Dashboard\ScriptsSettingController@index')->name('dashboard_scripts.index');
        Route::post('/post_data', 'Dashboard\ScriptsSettingController@post_data')->name('dashboard_scripts.post_data');
        Route::get('/get_data_by_id', 'Dashboard\ScriptsSettingController@get_data_by_id')->name('dashboard_scripts.get_data_by_id');
    });

    // Dashboard adv_block
    Route::group(['prefix' => '/adv_block'], function () {
        Route::get('', 'Dashboard\AdvBlockController@index')->name('dashboard_adv_block.index');
        Route::post('/post_data', 'Dashboard\AdvBlockController@post_data')->name('dashboard_adv_block.post_data');
        Route::get('/get_data_by_id', 'Dashboard\AdvBlockController@get_data_by_id')->name('dashboard_adv_block.get_data_by_id');
    });

});
