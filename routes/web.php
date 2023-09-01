<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
use App\Models\Product;

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

// Route::get('/', function () {
//     return view('homepage');
// });

Route::get('/', [ProductController::class, 'allProduct'])->name('homepage');
// ->middleware('auth')

Route::get('/add/product', [ ProductController::class, 'addProduct'])->name('addProduct')->middleware('is_admin');
Route::post('/store/product', [ ProductController::class, 'storeProduct'])->name('storeProduct')->middleware('is_admin');
Route::get('/view/product', [ProductController::class, 'viewProduct'])->name('viewProduct');

Route::get('/edit/page', [ProductController::class, 'editPage'])->name('editPage')->middleware('is_admin');
Route::get('/edit/product/{id}', [ProductController::class, 'editProduct'])->name('editProduct')->middleware('is_admin');
Route::patch('/update/product/{id}', [ProductController::class, 'updateProduct'])->name('updateProduct')->middleware('is_admin');
Route::delete('/delete/product/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct')->middleware('is_admin');
Route::get('/confirm/delete/{id}', [ProductController::class, 'confirmDelete'])->name('confirmDelete')->middleware('is_admin');

Route::get('/add/category', [CategoryController::class, 'addCategory'])->name('addCategory')->middleware('is_admin');
Route::post('/store/category', [CategoryController::class, 'storeCategory'])->name('storeCategory')->middleware('is_admin');

Route::get('/register', [AuthController::class, 'registerPage'])->name('registerPage')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/view-cart', [CartController::class, 'viewCart'])->name('viewCart')->middleware('auth');
Route::match(['get', 'post'], '/add-to-cart/{productId}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('addToCart')->middleware('auth');
Route::patch('/update-quantity/{id}', [CartController::class, 'updateQuantity'])->name('updateQuantity')->middleware('auth');

Route::get('/invoice/create', [InvoiceController::class, 'createInvoice'])->name('createInvoice');
Route::post('/store/invoice', [ InvoiceController::class, 'storeInvoice'])->name('storeInvoice');
Route::get('/view/receipt/{invoiceId}', 'InvoiceController@viewReceipt')->name('viewReceipt');



