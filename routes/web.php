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

use App\Http\Middleware\CheckAdmin;

App::setLocale('de');

Route::get('/', function () {
    return view('pages.home');
})->middleware(['auth']);

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return redirect('/home');
    });

    Route::get('/home', 'HomeController@index')->name('pages.home');
    Route::get('/home/getProjectPlaylist/{id}', 'HomeController@getProjectPlaylist');
    Route::get('/home/getPlaylistVideoclip/{id}', 'HomeController@getPlaylistVideoclip');
    Route::get('/home/getHistory', 'HomeController@getHistory');
    Route::get('/home/clearHistory', 'HomeController@clearHistory');

    Route::get('/project', 'ProjectController@index');
    Route::get('/project/create', 'ProjectController@create');
    Route::get('/project/edit/{id}', 'ProjectController@edit');
    Route::post('/project/store', 'ProjectController@store');
    Route::post('/project/update/{id}', 'ProjectController@update');
    Route::get('/project/destroy/{id}', 'ProjectController@destroy');

    Route::get('/playlist', 'PlaylistController@index');
    Route::get('/playlist/create', 'PlaylistController@create');
    Route::get('/playlist/edit/{id}', 'PlaylistController@edit');
    Route::post('/playlist/store', 'PlaylistController@store');
    Route::post('/playlist/update/{id}', 'PlaylistController@update');
    Route::get('/playlist/destroy/{id}', 'PlaylistController@destroy');
    Route::post('/playlist/activatePlaylist', 'PlaylistController@activatePlaylist');
    Route::post('/playlist/deactivatePlaylist', 'PlaylistController@deactivatePlaylist');

    Route::get('/videoclip', 'VideoclipController@index');
    Route::get('/videoclip/create', 'VideoclipController@create');
    Route::get('/videoclip/edit/{id}', 'VideoclipController@edit');
    Route::post('/videoclip/store', 'VideoclipController@store');
    Route::post('/videoclip/update/{id}', 'VideoclipController@update');
    Route::get('/videoclip/destroy/{id}', 'VideoclipController@destroy');
    Route::post('/videoclip/import', 'VideoclipController@import');
    Route::get('/videoclip/export', 'VideoclipController@export');
    Route::get('/videoclip/clear', 'VideoclipController@clear');

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

Route::group(['middleware' => [CheckAdmin::class]], function () {
    Route::get('/customer', 'CustomerController@index');
    Route::post('/customer/login', 'CustomerController@login');
    Route::get('/customer/destroy/{id}', 'CustomerController@destroy');
});

//Route::get('/project/url/{url}', 'HomeController@client');

Route::get('/{customer}/{project}/index.html', 'HomeController@client');