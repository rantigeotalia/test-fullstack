<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

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
    return view('welcome');
});

Route::get('/', [CustomerController::class, 'index']);

Route::post('/customer', [CustomerController::class, 'index'])->name('customer');
Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
Route::get('/customer/data', [CustomerController::class, 'data'])->name('customer.data');
Route::get('/customer/input', [CustomerController::class, 'input'])->name('customer.input');
Route::post('/customer/create', [CustomerController::class, 'create'])->name('customer.create');

/*rest*/
Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
Route::get('/customer/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::post('/customer/update', [CustomerController::class, 'update'])->name('customer.update');
Route::delete('/customer/destroy/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
