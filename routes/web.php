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
Route::post('/confirm-void', 'LoginController@confirmVoid');

Route::group(['prefix' => 'home'], function()
{
    Route::get('main', 'MainController@home');
    Route::get('toggle', 'MainController@toggleProduction');
    Route::post('create-news', 'MainController@createNews');
    Route::get('remove-news/{news_id}', 'MainController@removeNews');
});

Route::group(['prefix' => 'user'], function()
{
    Route::get('main', 'UserController@user');
    Route::get('deactivate-user/{usr_id}', 'UserController@deactivateUser');
    Route::get('reactivate-user/{usr_id}', 'UserController@reactivateUser');
    Route::get('profile', 'UserController@profile');

    Route::post('search-user', 'UserController@searchUser');
    Route::post('create-user', 'UserController@createUser');
    Route::post('forgot-password', 'UserController@forgotPassword');
    Route::post('reset-password', 'UserController@resetPassword');
    Route::post('edit-user/{usr_id}', 'UserController@editUser');
    Route::post('upload-avatar/{usr_id}', 'UserController@uploadAvatar');
    Route::post('user-password', 'UserController@savePassword');
    Route::post('save-profile/{usr_id}', 'UserController@saveProfile');
});

Route::group(['prefix' => 'customer'], function()
{
    Route::get('manage', 'CustomerController@manage');
    Route::get('deactivate-customer/{cus_id}', 'CustomerController@deactivateCustomer');
    Route::get('reactivate-customer/{cus_id}', 'CustomerController@reactivateCustomer');

    Route::post('search-customer', 'CustomerController@searchCustomer');
    Route::post('create-customer', 'CustomerController@createCustomer');
    Route::post('edit-customer/{cus_id}', 'CustomerController@editCustomer');
    Route::post('change-price', 'CustomerController@changeProductPrice');
    

});

Route::group(['prefix' => 'print'], function()
{   
    Route::get('user', 'PrintController@alluserDetails');

    Route::get('customer/{pay_uuid}', 'PrintController@customerDetails');
    Route::get('customer', 'PrintController@allcustomerDetails');

    Route::get('supplier/{pay_uuid}', 'PrintController@supplierDetails');
    Route::get('supplier', 'PrintController@allsupplierDetails');

    Route::get('product/{pay_uuid}', 'PrintController@productDetails');
    Route::get('product', 'PrintController@allproductDetails');

    Route::get('salesdetails', 'PrintController@allsaleDetails');
    Route::get('oppositedetails', 'PrintController@alloppositeDetails');

    Route::post('sales-reports', 'PrintController@allsalesReports');
    Route::post('transaction-reports', 'PrintController@alltransactionReports');
    Route::post('production-reports', 'PrintController@allproductionReports');
    Route::post('purchases-reports', 'PrintController@allpurchasesReports');
    Route::get('sales-receipt', 'PrintController@salesReceipt');
    Route::get('payment-receipt', 'PrintController@paymentReceipt');
    Route::get('delivery-receipt', 'PrintController@deliveryReceipt');
    Route::get('bad-order-receipt', 'PrintController@badorderReceipt');
});

Route::group(['prefix' => 'production'], function()
{
    Route::get('tank', 'ProductionController@tank');
    Route::get('manage', 'ProductionController@manage');
    Route::get('activate/{prd_uuid}', 'ProductionController@activateProduct');
    Route::get('tank-activation/{tnk_id}/{tnk_active}', 'ProductionController@tankActivation');
    
    Route::post('verify', 'ProductionController@verifyProduction');
    Route::post('toggle', 'ProductionController@toggleProduction');///{pdn_flag}
    Route::post('add-empty-goods', 'ProductionController@createProduct');
    Route::post('add-supplier', 'ProductionController@createSupplier');
    Route::post('add-quantity', 'ProductionController@addQuantity');
    Route::post('edit-product', 'ProductionController@editItem');
    Route::post('add-tank', 'ProductionController@createTank');
    Route::post('edit-tank/{tnk_id}', 'ProductionController@editTank');
    Route::post('refill-tank/{tnk_id}', 'ProductionController@refillTank');

});

Route::group(['prefix' => 'product'], function()
{
    Route::get('manage', 'ProductController@manage');
    Route::get('opposite', 'ProductController@opposite');
    Route::get('deactivate-product/{prd_id}', 'ProductController@deactivateProduct');
    Route::get('reactivate-product/{prd_id}', 'ProductController@reactivateProduct');
    Route::get('opsdeactivate-product/{ops_id}', 'ProductController@opsdeactivateProduct');
    Route::get('opsreactivate-product/{ops_id}', 'ProductController@opsreactivateProduct');


    Route::post('create-supplier', 'ProductController@createSupplier');
    Route::post('search-user', 'ProductController@searchProduct');
    Route::post('edit-product', 'ProductController@editProduct');
    Route::post('add-product', 'ProductController@createProduct');
    Route::post('add-quantity', 'ProductController@addQuantity');
    Route::post('trade-canisters', 'ProductController@tradeCanisters');

    Route::post('add-opposition', 'ProductController@addOpposition');
    Route::post('edit-opposition', 'ProductController@editOpposition');
    Route::post('search-opposition', 'ProductController@searchOpposition');
    
});

Route::group(['prefix' => 'reports'], function()
{
    Route::get('sales', 'ReportsController@sales');
    Route::get('sales/today', 'ReportsController@salesToday');
    Route::post('sales-filter', 'ReportsController@salesFilter');
    
    Route::get('payments/today', 'ReportsController@paymentsToday');
    Route::post('payments/date-filter', 'ReportsController@paymentsFilter');

    Route::get('transactions', 'ReportsController@transactions');
    Route::get('transactions/today', 'ReportsController@transactionsToday');
    Route::post('transactions-filter', 'ReportsController@transactionsFilter');

    Route::post('production', 'ReportsController@production');
    Route::post('production-filter', 'ReportsController@productionFilter');
});

Route::group(['prefix' => 'sales'], function()
{
    Route::get('main', 'SalesController@main');
    Route::get('payments', 'SalesController@payments');

    Route::post('select-customer', 'SalesController@selectCustomer');
    Route::post('create-customer', 'SalesController@createCustomer');
    Route::post('payment', 'SalesController@paymentSales');
    Route::post('pay', 'SalesController@payPending');
    Route::post('add-canister', 'SalesController@addCanister');
    Route::post('search-product', 'SalesController@searchProduct');
    //TEST
    Route::post('test-transaction', 'SalesController@test');
    Route::get('print', 'PrintController@receiptDetails');
});

Route::group(['prefix' => 'supplier'], function()
{
    Route::get('manage', 'SupplierController@manage');
    Route::get('deactivate-supplier/{sup_id}', 'SupplierController@deactivateSupplier');
    Route::get('reactivate-supplier/{sup_id}', 'SupplierController@reactivateSupplier');
    
    Route::post('create-supplier', 'SupplierController@createSupplier');
    Route::post('edit-supplier/{sup_id}', 'SupplierController@editSupplier');
    Route::post('search-supplier', 'SupplierController@searchSupplier');
    Route::post('upload-avatar', 'SupplierController@uploadAvatar');
});
