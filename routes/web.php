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

Route::get('/', 'LoginController@login');
Route::post('/validate', 'LoginController@validateUser');
Route::get('/logout', 'LoginController@logout');


Route::group(['prefix' => 'home'], function()
{
    Route::get('main', 'MainController@home');
});

Route::group(['prefix' => 'customer'], function()
{
    Route::get('manage', 'CustomerController@manage');
});

Route::group(['prefix' => 'user'], function()
{
    Route::get('main', 'UserController@user');
    Route::get('delete-user/{usr_id}', 'UserController@deleteUser');

    Route::post('search-user', 'UserController@searchUser');
    Route::post('create-user', 'UserController@createUser');
});

Route::group(['prefix' => 'product'], function()
{
    Route::get('manage', 'ProductController@manage');
});

Route::group(['prefix' => 'supplier'], function()
{
    Route::get('manage', 'SupplierController@manage');
});