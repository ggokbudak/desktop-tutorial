<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');

  
    });
  
    Route::group(['prefix' => 'permissions', 'namespace' => 'Permissions'], function() {
        Route::get('/find', 'PermissionController@find');
        Route::get('/allAna', 'PermissionController@allAna');
        Route::post('', 'PermissionController@create');
        Route::put('', 'PermissionController@edit');
        Route::delete('{id}', 'PermissionController@delete');
    });
    Route::group(['prefix' => 'roles', 'namespace' => 'Roles'], function() {
        Route::get('/find', 'RolesController@find');
        Route::get('/permissions', 'RolesController@permissions');
        Route::post('', 'RolesController@create');
        Route::put('', 'RolesController@edit');
        Route::delete('{id}', 'RolesController@delete');
    });
    Route::group(['prefix' => 'users', 'namespace' => 'Users'], function() {
        Route::get('/find', 'UsersController@find');
        Route::get('/roles', 'UsersController@roles');
        Route::post('', 'UsersController@create');
        Route::put('', 'UsersController@edit');
        Route::put('/password', 'UsersController@editPass');
        Route::delete('{id}', 'UsersController@delete');
    });
    
    

   

    Route::group(['prefix' => 'messages', 'namespace' => 'Messages'], function() {
        Route::get('find', 'MessagesController@find');
        Route::post('createMessages', 'MessagesController@create');
        Route::put('', 'MessagesController@edit');

        Route::delete('deleteMessages/{id}', 'MessagesController@delete');
        

    });

    

