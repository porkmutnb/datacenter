<?php

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

Route::get('/', 'HomeController@index');

Route::get('login', 'Auth\LoginController@formLogin');
Route::post('login', 'Auth\LoginController@login');
Route::get('register', 'Auth\RegisterController@formRegister');
Route::post('register', 'Auth\RegisterController@register');

Route::middleware(['user'])->group(function () {
    Route::get('profile', 'ProfileController@index');
    Route::get('logout', 'Auth\LoginController@logout');
});

Route::prefix('admin')->group(function () {

    Route::get('/login', 'Auth\LoginController@formAdminLogin');
    Route::post('/login', 'Auth\LoginController@AdminLogin');
    Route::post('category/{type}', 'BackOffice@manageCategory');

    Route::middleware(['admin'])->group(function () {
        Route::get('/', 'BackOfficeController@index');
        Route::get('/category', 'BackOfficeController@category');
        Route::post('/addCategory', 'BackOfficeController@addCategory');
        Route::get('/profile', 'BackOfficeController@profile');
        Route::get('/logout', 'Auth\LoginController@logoutAdmin');
    });

});
