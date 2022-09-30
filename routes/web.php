<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::middleware(['auth'])->group(function () {
    Route::resource('item', 'ItemController');

    Route::get('/', 'HomeController@index');
    Route::get('/item', 'ItemController@index');
    Route::get('/addItem', 'ItemController@create');
    Route::get('/transaction', 'InvoiceController@index');

    Route::post('/submitAddedItem', 'HistoryController@buyItem');
    Route::post('/formEditItem', 'ItemController@showEditModal');
    Route::post('/formDetailInvoice', 'InvoiceController@showDetailModal');
});

Auth::routes();

