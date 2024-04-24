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

Route::get('/', function () {
    return redirect('login');

});

Route::get('/report/checkout', function () {
    return view('report.checkout');
})->name("checkout");

Route::get('/report/amn', function () {
    return view('report.amn');
})->name("amn");

Route::get('/report/bookednow', function () {
    return view('report.booked');
})->name("bookednow");


Route::get('/dashboard', function () {
    return redirect('admin');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
