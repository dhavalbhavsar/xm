<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('company.form');
//});
Route::get('/', 'CompanyController@index')->name('company.historical');
Route::post('/historical-quotes', 'CompanyController@historicalQuotes')->name('historical.quotes');
