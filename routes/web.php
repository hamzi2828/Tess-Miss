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
Route::get('/merchantsdocuments', [MerchantsController::class, 'create_merchants_documents'])->name('create.merchants.documents');
Route::Post('/store/merchantsdocuments', [MerchantsController::class, 'store_merchants_documents'])->name('store.merchants.documents');
Route::get('/merchantsSales', [MerchantsController::class, 'create_merchants_sales'])->name('create.merchants.sales');
Route::Post('/store/merchantsSales', [MerchantsController::class, 'store_merchants_sales'])->name('store.merchants.sales');
Route::get('/merchantService', [MerchantsController::class, 'create_merchants_services'])->name('create.merchants.services.form');
Route::Post('/store/merchantService', [MerchantsController::class, 'store_merchants_services'])->name('store.merchants.services');




