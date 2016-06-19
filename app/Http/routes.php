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

Route::get('admin',['as'=>'admin.index', 'uses'=>'PostsAdminController@index']);
Route::get('admin/create',['as'=>'admin.create', 'uses'=>'PostsAdminController@create']);
Route::post('admin/store',['as'=>'admin.store', 'uses'=>'PostsAdminController@store']);
