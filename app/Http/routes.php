<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','PostsController@index');

Route::group(['prefix'=>'admin'],function(){
    Route::group(['prefix'=>'posts'],function() {
        Route::get('', ['as' => 'admin.index', 'uses' => 'PostsAdminController@index']);
        Route::get('create', ['as' => 'admin.create', 'uses' => 'PostsAdminController@create']);
        Route::post('store', ['as' => 'admin.store', 'uses' => 'PostsAdminController@store']);
        Route::get('edit/{id}', ['as' => 'admin.edit', 'uses' => 'PostsAdminController@edit']);
        Route::put('update/{id}', ['as' => 'admin.update', 'uses' => 'PostsAdminController@update']);
        Route::get('destroy/{id}', ['as' => 'admin.destroy', 'uses' => 'PostsAdminController@destroy']);
        Route::get('cancel', ['as' => 'admin.cancel', 'uses' => 'PostsAdminController@cancel']);
    });
});
Route::group(['prefix'=>'password'],function() {
    Route::get('email', ['as' => 'password.index','uses'=>'Auth\PasswordController@index']);
    Route::post('email', ['as' => 'password.enviar','uses'=> 'Auth\PasswordController@enviar']);
    Route::get('reset/{token}', ['as' => 'password.getreset','uses'=>'Auth\PasswordController@getResetar']);
    Route::post('reset', ['as' => 'password.reset','uses'=>'Auth\PasswordController@resetar']);
});
Route::group(['prefix'=>'auth'],function() {
    Route::get('register', ['as' => 'auth.register','uses'=>'Auth\AuthController@registrar']);
    Route::post('register', ['as' => 'auth.create','uses'=>'Auth\AuthController@create']);
    Route::get('login',['as' => 'auth.login','uses'=>'Auth\AuthController@logar']);
    Route::post('login', ['as' => 'auth.logar','uses'=>'Auth\AuthController@acessar']);
    Route::get('logout', ['as' => 'auth.logout', function () {
        Auth::logout();
        return  redirect('/');
    }]);
    Route::get('resend', ['as' => 'auth.getresend','uses'=>'Auth\AuthController@getResend']);
    Route::post('resend', ['as' => 'auth.resend','uses'=>'Auth\AuthController@postResend']);
    Route::get('verify/{confirmationCode}', ['as' => 'confirmation_path', 'uses' => 'Auth\AuthController@confirm']);
});