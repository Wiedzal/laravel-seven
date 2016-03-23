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

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect']
], function(){
    
    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);
    
    get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
    
    post('auth/register', ['as' => 'auth.register', 'uses' => 'AuthController@postRegister']);
    post('auth/login', ['as' => 'auth.login', 'uses' => 'AuthController@postLogin']);

    get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    post('profile/update', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
});