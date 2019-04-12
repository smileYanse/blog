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

/*Route::get('/', function () {   //默认路由
    return view('welcome');
});
Route::get('zhx',function (){
    return 123;
});
Route::any('user','User\UserController@index');
Route::any('user','User\UserController@index');
Route::get('test','TestController@index');
Route::get('user/env','User\UserController@env');*/
Route::any('login','User\LoginController@login');
Route::any('register','User\LoginController@register');
Route::any('user_reg','User\LoginController@user_reg');
Route::any('user_login','User\LoginController@user_login');



//创建logincharge中间件的名 php artisan make:middleware LoginCharge
Route::group(['middleware'=>'logincharge'],function (){
    Route::any('/', 'User\UserController@index'); //默认路由
    Route::any('index','User\UserController@index');
});
