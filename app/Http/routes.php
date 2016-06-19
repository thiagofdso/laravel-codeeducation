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