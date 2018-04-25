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

Route::get('/', function () {
    return view('pages.home');
})->middleware(['auth']);

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('pages.home');
    });

    Route::get('/home', 'HomeController@index')->name('pages.home');

    Route::get('/project', 'ProjectController@index');
    Route::get('/project/create', 'ProjectController@create');
    Route::get('/project/edit/{id}', 'ProjectController@edit');

    Route::get('/playlist', 'PlaylistController@index');
    Route::get('/playlist/create', 'PlaylistController@create');
    Route::get('/playlist/edit/{id}', 'PlaylistController@edit');

    Route::get('/videoclip', 'VideoclipController@index');
    Route::get('/videoclip/create', 'VideoclipController@create');
    Route::get('/videoclip/edit/{id}', 'VideoclipController@edit');
    Route::post('/videoclip/store', 'VideoclipController@store');
    Route::post('/videoclip/update/{id}', 'VideoclipController@update');
    Route::get('/videoclip/destroy/{id}', 'VideoclipController@destroy');

    Route::get('/message', 'MessageController@index');
    Route::get('/message/create', 'MessageController@create');
    Route::get('/message/edit/{id}', 'MessageController@edit');
    Route::post('/message/store', 'MessageController@store');
    Route::post('/message/update/{id}', 'MessageController@update');
    Route::get('/message/destroy/{id}', 'MessageController@destroy');

    Route::get('/logo', 'LogoController@index');
    Route::get('/logo/create', 'LogoController@create');
    Route::get('/logo/edit/{id}', 'LogoController@edit');
    Route::post('/logo/store', 'LogoController@store');
    Route::post('/logo/update/{id}', 'LogoController@update');
    Route::get('/logo/destroy/{id}', 'LogoController@destroy');
    Route::post('logo/upload', 'LogoController@upload');
});