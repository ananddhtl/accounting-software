<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AccountGroupController;
use App\Http\Controllers\MainAccountController;
use App\Http\Controllers\CashonSalesController;
use App\Http\Controllers\CreditonSalesController;
use App\Http\Controllers\CashonPurchaseController;
use App\Http\Controllers\CreditonPurchaseController;

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

Route::get('/', function () {
    return view('loginorsignup.login');
});

Route::get('/payment', function () {
    return view('pages.payment');
});
Route::get('/profitandloss', function () {
    return view('pages.profitandloss');
});

Route::get('/amountreceived', function () {
    return view('pages.amountreceived');
});
Route::get('/salesoncash', function () {
    return view('pages.sales.cash');
});
Route::get('/salesoncredit', function () {
    return view('pages.sales.credit');
});
Route::get('/purchaseoncash', function () {
    return view('pages.purchase.cash');
});
Route::get('/purchaseoncredit', function () {
    return view('pages.purchase.credit');
});
Route::get('/ledger', function () {
    return view('pages.ledger');
});

Route::get('/dashboard', function () {
    return view('pages.index');
});


//Login and Register routes for Admin users
Route::post('/addAdminUser', [AdminUsersController::class, 'store']);

Route::POST('/adminUserLogin', [AdminUsersController::class, 'login']);

Route::get('/logout-adminuser', function () {
    session()->forget('sessionAdminUserId');
    return redirect('/');
});
//

// main account

Route::post('/mainAccountStoreData', [MainAccountController::class, 'store']);
Route::get('/ledger', [MainAccountController::class, 'index']);
Route::get('/delete-mainaccountdata/{sn}', [MainAccountController::class, 'destroy']);
Route::get('/ledger/{sn}', [MainAccountController::class, 'edit']);
Route::post('/mainAccountUpdateData/{sn}', [MainAccountController::class, 'update']);

//end main account
Route::get('/searchPartyName/{searchkey}', [MainAccountController::class, 'searchPartyName']);

//

//cash on sales
Route::post('/cashOnSalesStoreData', [CashonSalesController::class, 'store']);
Route::get('/salesoncash', [CashonSalesController::class, 'index']);
Route::get('/deletecashonSales/{id}', [CashonSalesController::class, 'destroy']);
Route::get('/salesoncash/{id}', [CashonSalesController::class, 'edit']);
Route::post('/salesonCashUpdate/{id}', [CashonSalesController::class, 'update']);

//credit on sales
Route::post('/creditOnSalesStoreData', [CreditonSalesController::class, 'store']);
Route::get('/salesoncredit', [CreditonSalesController::class, 'index']);
Route::get('/deletecreditonSales/{id}', [CreditonSalesController::class, 'destroy']);
Route::get('/salesoncredit/{id}', [CreditonSalesController::class, 'edit']);
Route::post('/salesonCreditUpdate/{id}', [CreditonSalesController::class, 'update']);

//


//cash on Purchase
Route::post('/cashOnPurchaseStoreData', [CashonPurchaseController::class, 'store']);
Route::get('/purchaseoncash', [CashonPurchaseController::class, 'index']);
Route::get('/deletecashonPurchase/{id}', [CashonPurchaseController::class, 'destroy']);
Route::get('/salesoncashPurchase/{id}', [CashonPurchaseController::class, 'edit']);
Route::post('/salesonPurchaseCashUpdate/{id}', [CashonPurchaseController::class, 'update']);
//

//credit on Purchase
Route::post('/creditOnPurchaseStoreData', [CreditonPurchaseController::class, 'store']);
Route::get('/purchaseoncredit', [CreditonPurchaseController::class, 'index']);
Route::get('/deletecreditonPurchase/{id}', [CreditonPurchaseController::class, 'destroy']);
Route::get('/salesoncreditonPurchase/{id}', [CreditonPurchaseController::class, 'edit']);
Route::post('/salesoncreditUpdatePurchase/{id}', [CreditonPurchaseController::class, 'update']);