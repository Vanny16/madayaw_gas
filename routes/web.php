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
    Route::get('deactivate-customer/{cus_id}', 'CustomerController@deactivateCustomer');
    Route::get('reactivate-customer/{cus_id}', 'CustomerController@reactivateCustomer');

    Route::post('search-customer', 'CustomerController@searchCustomer');
    Route::post('create-customer', 'CustomerController@createCustomer');
    Route::post('edit_customer/{cus_id}', 'CustomerController@editCustomer');

});

Route::group(['prefix' => 'user'], function()
{
    Route::get('main', 'UserController@user');
    Route::get('deactivate-user/{usr_id}', 'UserController@deactivateUser');
    Route::get('reactivate-user/{usr_id}', 'UserController@reactivateUser');
    Route::get('profile', 'UserController@profile');

    Route::post('search-user', 'UserController@searchUser');
    Route::post('create-user', 'UserController@createUser');
    Route::post('edit-user/{usr_id}', 'UserController@editUser');
    Route::post('upload-avatar/{usr_id}', 'UserController@uploadAvatar');
    Route::post('user-password', 'UserController@savePassword');
});

Route::group(['prefix' => 'product'], function()
{
    Route::get('manage', 'ProductController@manage');
    Route::get('deactivate-product/{prd_id}', 'ProductController@deactivateProduct');
    Route::get('reactivate-product/{prd_id}', 'ProductController@reactivateProduct');
    // Route::post('test', 'ProductController@test');

    Route::post('create-supplier', 'ProductController@createSupplier');
    Route::post('search-user', 'ProductController@searchProduct');
    Route::post('edit-product', 'ProductController@editProduct');
    Route::post('add-product', 'ProductController@createProduct');
    Route::post('add-quantity', 'ProductController@addQuantity');
    
});

Route::group(['prefix' => 'supplier'], function()
{
    Route::get('manage', 'SupplierController@manage');
    Route::get('deactivate-supplier/{sup_id}', 'SupplierController@deactivateSupplier');
    Route::get('reactivate-supplier/{sup_id}', 'SupplierController@reactivateSupplier');
    
    Route::post('create-supplier', 'SupplierController@createSupplier');
    Route::post('edit-supplier/{sup_id}', 'SupplierController@editSupplier');
    Route::post('search-supplier', 'SupplierController@searchSupplier');
});

Route::group(['prefix' => 'print'], function()
{
    Route::get('customer/{pay_uuid}', 'PrintController@customerDetails');
    Route::get('customer', 'PrintController@allcustomerDetails');

    Route::get('supplier/{pay_uuid}', 'PrintController@supplierDetails');
    Route::get('supplier', 'PrintController@allsupplierDetails');

    Route::get('product/{pay_uuid}', 'PrintController@productDetails');
    Route::get('product', 'PrintController@allproductDetails');
});