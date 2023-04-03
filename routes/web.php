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
    Route::resource('user', 'UserController')->middleware('can:admin-permission');
    Route::resource('item', 'ItemController')->middleware('can:admin-permission');
    
    Route::get('/', 'HomeController@index');
    
    Route::get('/item', 'ItemController@index')->middleware('can:admin-permission');
    Route::get('/addItem', 'ItemController@create')->middleware('can:admin-permission');
    Route::get('/transaction', 'InvoiceController@index');
    Route::get('/addInvoice', 'InvoiceController@create');
    // Route::get('/report', 'HistoryController@index');
    Route::get('/buyReport', 'HistoryController@buyIndex')->middleware('can:admin-permission');
    Route::get('/sellReport', 'InvoiceController@sellIndex')->middleware('can:admin-permission');
    Route::get('/user', 'UserController@index')->middleware('can:admin-permission');
    Route::get('/updateDatatable', 'InvoiceController@updateDatatable')->middleware('can:admin-permission');

    Route::post('/submitAddedItem', 'HistoryController@buyItem')->middleware('can:admin-permission');
    Route::post('/formEditItem', 'ItemController@showEditModal')->middleware('can:admin-permission');
    Route::post('/editItem/{id}', 'ItemController@update')->middleware('can:admin-permission');
    Route::post('/formDetailInvoice', 'InvoiceController@showDetailModal');
    Route::post('/submitInvoice', 'InvoiceController@store');
    Route::post('/showReport', 'HistoryController@show')->middleware('can:admin-permission');
    Route::post('/formDetailHistory', 'HistoryDetailsController@showDetailModal')->middleware('can:admin-permission');
    Route::post('/formDetailInvoiceReport', 'InvoiceDetailsController@showDetailModalReport');
    Route::post('/calcProfit', 'InvoiceController@calcProfit');
    Route::post('/formEditUser', 'UserController@showEditModal')->middleware('can:admin-permission');
    Route::post('/sellDatatable', 'InvoiceController@datatable')->middleware('can:admin-permission');
    Route::post('/generateSellPdf', 'InvoiceController@generateSellPdf')->middleware('can:admin-permission');
});

Auth::routes();

