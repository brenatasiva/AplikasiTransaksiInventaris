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
    Route::resource('user', 'UserController');

    Route::get('/', 'HomeController@index');
   
    Route::get('/item', 'ItemController@index');
    Route::get('/addItem', 'ItemController@create');
    Route::get('/transaction', 'InvoiceController@index');
    Route::get('/addInvoice', 'InvoiceController@create');
    // Route::get('/report', 'HistoryController@index');
    Route::get('/buyReport', 'HistoryController@buyIndex');
    Route::get('/sellReport', 'InvoiceController@sellIndex');
    Route::get('/user', 'UserController@index');
    Route::get('/updateDatatable', 'InvoiceController@updateDatatable');

    Route::post('/submitAddedItem', 'HistoryController@buyItem');
    Route::post('/formEditItem', 'ItemController@showEditModal');
    Route::post('/editItem/{id}', 'ItemController@update');
    Route::post('/formDetailInvoice', 'InvoiceController@showDetailModal');
    Route::post('/submitInvoice', 'InvoiceController@store');
    Route::post('/showReport', 'HistoryController@show');
    Route::post('/formDetailHistory', 'HistoryDetailsController@showDetailModal');
    Route::post('/formDetailInvoiceReport', 'InvoiceDetailsController@showDetailModalReport');
    Route::post('/calcProfit', 'InvoiceController@calcProfit');
    Route::post('/formEditUser', 'UserController@showEditModal');
    Route::post('/sellDatatable', 'InvoiceController@datatable');
    Route::post('/generateSellPdf', 'InvoiceController@generateSellPdf');
});

Auth::routes();

