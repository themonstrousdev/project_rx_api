  
<?php


// Finances
=======
// Ledger Controller
$route = env('PACKAGE_ROUTE', '').'/ledger/';
$controller = 'Increment\Finance\Http\LedgerController@';
Route::post($route.'create', $controller."addEntry");
Route::post($route.'retrieve_by_id', $controller."retrieveByID");
Route::post($route.'retrieve', $controller."retrieve");
Route::post($route.'retrieve_all', $controller."retrieveAll");
Route::post($route.'summary', $controller."summary");
Route::post($route.'update', $controller."update");
Route::post($route.'delete', $controller."delete");
Route::post($route.'retrieve_merchant', $controller."retrieveForMerchant");
Route::get($route.'test', $controller."test");


// Cash Payment Controller
$route = env('PACKAGE_ROUTE', '').'/cash_payments/';
$controller = 'Increment\Finance\Http\CashPaymentController@';
Route::post($route.'create', $controller."addPayment");
Route::post($route.'update', $controller."updateStatus");


// Credit Payment Controller
$route = env('PACKAGE_ROUTE', '').'/credit_payments/';
$controller = 'Increment\Finance\Http\CCDCController@';
Route::post($route.'create', $controller."createPaymentIntent");
Route::post($route.'create_payment_method', $controller."createPaymentMethod");
Route::post($route.'retrieve', $controller."retrieveIntent");
Route::post($route.'create_payment', $controller."createEntry");
Route::post($route.'payment_methods', $controller."retrievePaymentMethods");
Route::post($route.'pay_purchase', $controller."payByCreditCard");
=======


// Withdrawals Controller
$route = env('PACKAGE_ROUTE', '').'/withdrawals/';
$controller = 'Increment\Finance\Http\WithdrawalController@';
Route::post($route.'create', $controller."create");
Route::post($route.'retrieve', $controller."retrieve");
