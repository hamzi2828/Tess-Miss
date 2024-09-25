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




