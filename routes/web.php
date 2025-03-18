<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('invoice', InvoiceController::class);
Route::post('/invoice/data', [InvoiceController::class, 'GetInvoiceData'])->name('invoice.data');