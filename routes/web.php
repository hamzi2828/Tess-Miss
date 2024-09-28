<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\MerchantCategoriesController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MerchantsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!  
|
*/

Route::get('/', function () {
    return view('pages.dashboard.index');
});


Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('users', UserController::class);
Route::resource('departments', DepartmentController::class);
Route::resource('documents', DocumentsController::class);
Route::resource('services', ServicesController::class);
Route::resource('merchant-categories', MerchantCategoriesController::class);
Route::resource('countries', CountryController::class);
Route::resource('merchants', MerchantsController::class);
Route::get('/merchantskyc', [MerchantsController::class, 'create_merchants_kfc'])->name('create.merchants.kfc');
Route::Post('/store/merchantskyc', [MerchantsController::class, 'store_merchants_kyc'])->name('store.merchants.kyc');
Route::get('/editmechnatkyc', [MerchantsController::class, 'edit_merchants_kyc'])->name('edit.merchants.kyc');

Route::get('/createMerchantsDocuments', [MerchantsController::class, 'create_merchants_documents'])->name('create.merchants.documents');
Route::Post('/storeMerchantsDocuments', [MerchantsController::class, 'store_merchants_documents'])->name('store.merchants.documents');
Route::get('/editMechnatDocuments', [MerchantsController::class, 'edit_merchants_documents'])->name('edit.merchants.documents');

Route::get('/CreateMerchantsSales', [MerchantsController::class, 'create_merchants_sales'])->name('create.merchants.sales');
Route::Post('/store/merchantsSales', [MerchantsController::class, 'store_merchants_sales'])->name('store.merchants.sales');
Route::get('/editMechnatSales', [MerchantsController::class, 'edit_merchants_sales'])->name('edit.merchants.sales');

Route::get('/CreateMerchantService', [MerchantsController::class, 'create_merchants_services'])->name('create.merchants.services');
Route::Post('/storeMerchantService', [MerchantsController::class, 'store_merchants_services'])->name('store.merchants.services');
Route::get('/editMerchantService', [MerchantsController::class, 'edit_merchants_services'])->name('edit.merchants.services');



