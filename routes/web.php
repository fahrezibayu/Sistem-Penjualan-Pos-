<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\AuthController@index')->name("login");
Route::post("/sign_in", "App\Http\Controllers\AuthController@sign_in");
Route::get("/sign_out", "App\Http\Controllers\AuthController@sign_out");

Route::middleware(['auth', 'cekrole:Admin'])->group(function () {

    // todo dashboard
    Route::get("/dashboard", "App\Http\Controllers\DashboardController@index");
    Route::post("/dashboard/search", "App\Http\Controllers\DashboardController@search");
    Route::get('/dashboard/chart', 'App\Http\Controllers\DashboardController@chart');
    // todo category
    Route::get("/master/category", "App\Http\Controllers\CategoryController@index");
    Route::post("/category/check_code", "App\Http\Controllers\CategoryController@check_code");
    Route::post("/category/save", "App\Http\Controllers\CategoryController@save");
    Route::get("/category/delete/{id}", "App\Http\Controllers\CategoryController@delete");
    Route::get("/master/category/edit/{id}", "App\Http\Controllers\CategoryController@edit");
    Route::post("/category/update", "App\Http\Controllers\CategoryController@update");
    // todo edc
    Route::get("/master/edc", "App\Http\Controllers\EdcController@index");
    Route::post("/edc/check_code", "App\Http\Controllers\EdcController@check_code");
    Route::post("/edc/save", "App\Http\Controllers\EdcController@save");
    Route::get("/edc/delete/{id}", "App\Http\Controllers\EdcController@delete");
    Route::get("/master/edc/edit/{id}", "App\Http\Controllers\EdcController@edit");
    Route::post("/edc/update", "App\Http\Controllers\EdcController@update");
    // todo promo diskon
    Route::get("/promo/diskon", "App\Http\Controllers\PromoController@index");
    Route::get("/promo/diskon/tambah", "App\Http\Controllers\PromoController@add");
    Route::get("/promo/diskon/diskon_menu", "App\Http\Controllers\PromoController@diskon_menu");
    Route::post("/promo/diskon/diskon_menu/save", "App\Http\Controllers\PromoController@save_diskon_menu");
    Route::get("//promo/diskon/diskon_nominal", "App\Http\Controllers\PromoController@diskon_nominal");
    Route::post("/promo/diskon/diskon_nominal/save", "App\Http\Controllers\PromoController@save_diskon_nominal");
    Route::get("/promo/diskon/diskon_persen", "App\Http\Controllers\PromoController@diskon_persen");
    Route::post("/promo/diskon/diskon_persen/save", "App\Http\Controllers\PromoController@save_diskon_persen");
    // todo promo paket
    Route::get("/promo/paket", "App\Http\Controllers\PromopaketController@index");
    Route::get("/promo/paket/tambah", "App\Http\Controllers\PromopaketController@add");
    Route::get("/promo/paket/discY", "App\Http\Controllers\PromopaketController@discY");
    // todo merchandise
    Route::get("/master/merchandise", "App\Http\Controllers\MerchandiseController@index");
    Route::get("/master/merchandise/data", "App\Http\Controllers\MerchandiseController@data");
    Route::post("/master/merchandise/save", "App\Http\Controllers\MerchandiseController@save");
    Route::get("/merchandise/delete/{id}", "App\Http\Controllers\MerchandiseController@delete");
    Route::get("/master/merchandise/edit/{id}", "App\Http\Controllers\MerchandiseController@edit");
    Route::post("/merchandise/update", "App\Http\Controllers\MerchandiseController@update");
    Route::post("/master/merchandise/update_stock", "App\Http\Controllers\MerchandiseController@update_stock");
    // todo user
    Route::get("/master/users", "App\Http\Controllers\UserController@index");
    Route::post("/users/save", "App\Http\Controllers\UserController@save");
    Route::get("/users/delete/{id}", "App\Http\Controllers\UserController@delete");
    Route::get("/master/users/edit/{id}", "App\Http\Controllers\UserController@edit");
    Route::post("/users/update", "App\Http\Controllers\UserController@update");
    Route::post("/data_session", "App\Http\Controllers\UserController@data_session");
    // todo setting
    Route::get("/setting/apps", "App\Http\Controllers\SettingController@apps");
    Route::get("/setting/struck", "App\Http\Controllers\SettingController@struck");
    Route::post("/setting/apps/update", "App\Http\Controllers\SettingController@update_apps");
    Route::post("/setting/struck/update", "App\Http\Controllers\SettingController@update_struck");

});

Route::middleware(['auth', 'cekrole:Kasir'])->group(function () {

    // todo pos
    Route::get("/pos", "App\Http\Controllers\PosController@index");
    Route::post("/pos/data_menu", "App\Http\Controllers\PosController@data_menu");
    Route::post("/pos/search_menu", "App\Http\Controllers\PosController@search_menu");
    Route::post("/pos/save", "App\Http\Controllers\PosController@save");
    Route::get("/pos/print/{id}", "App\Http\Controllers\PosController@struck");


});

Route::middleware(['auth','cekrole:Admin,Kasir'])->group(function () {

    // todo profile user
    Route::get("/setting/profile/", "App\Http\Controllers\SettingController@profile");
    Route::post("/setting/profile/update", "App\Http\Controllers\SettingController@update_profile");
    Route::post("/setting/profile/update_password", "App\Http\Controllers\SettingController@update_password");
    Route::get("/setting/profile/delete_photo/{id}", "App\Http\Controllers\SettingController@delete_photo");
    // todo data promo diskon dan get and disc y
    Route::get("/promo/diskon/data_detail_promo", "App\Http\Controllers\PromoController@detail_promo");
    Route::get("/promo/paket/data_detail_promo", "App\Http\Controllers\PromopaketController@detail_promo");
    // todo receipt
    Route::get("/print/receipt/{id}", "App\Http\Controllers\PosController@receipt");
    // todo report
    Route::get("/report/pos", "App\Http\Controllers\PosController@report");
    Route::post("/report/pos/search", "App\Http\Controllers\PosController@report_search");
    Route::get("/report/pos/detail/{id}", "App\Http\Controllers\PosController@detail_report");

});