<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/listproducts', function () {

    return view('pages.product.product-list');
});

// Route::get('/addproducts', function () {
//     return view('pages.product.addproduct.add-product');
// });

// Route::get('/categorylist', function () {
//     return view('pages.product.category');
// });


Route::get('/order-details', function () {
    return view('pages.order.order-details');
});

Route::get('/orderlist', function () {
    return view('pages.order.order-list');
});


Route::get('/allcustomers', function () {
    return view('pages.customer.all-customers');
});


Route::get('/reviews', function () {
    return view('pages.reviews.reviews');
});

Route::get('/referrals', function () {
    return view('pages.referral.referral');
});

// Route::get('/users-list', function () {
//     return view('pages.users.users-list');
// });


Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('users', UserController::class);
Route::get('users/list', [UserController::class, 'getUsers'])->name('users.list');



