<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;

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
    return view('welcome');
});
Route::get('/log', function () {
    return view('loginss/login');
});
Route::get('/reg', function () {
    return view('loginss/register');
});
route::get('/dashboard',function(){
    return view('dashboard/index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'admin'], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::get('products', [ProductController::class, 'index'])->name('products');
Route::get('products/create', [ProductController::class, 'create'])->name('pro_create');
Route::post('products/store', [ProductController::class, 'store'])->name('pro_store');
Route::post('delete_product', [ProductController::class,'destroy'])->name('pro_destroy');
Route::post('products/update/{id}', [ProductController::class,'update'])->name('pro_update');
Route::get('products/edit/{id}', [ProductController::class, 'edit']);
