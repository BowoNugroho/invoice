<?php
use App\ModelInvoice;
use App\ModelItem;
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
    return view('/');
});


// Route untuk menu
Route::get('home', 'controllerSeller@home');
Route::get('fromInvoice', 'controllerSeller@transaction');
Route::get('listTransaksi', 'controllerSeller@ListTransaksi');
// Route untuk ajax javascript 
Route::get('selectAjax', ['as'=>'selectAjax','uses'=>'controllerItem@getDetailItem']); 
// Route untuk controller penjual
Route::resource('home','controllerSeller'); 
Route::get('showItem', 'controllerSeller@showItem');
Route::get('showFormInsertSeller', 'controllerSeller@showFormInsertSeller');
Route::post('insertSeller', 'controllerSeller@insertSeller');
Route::post('insertTransaction', 'controllerSeller@insertTransaction');
Route::get('transaction', 'controllerSeller@getInvoice');
// Route untuk controller item
Route::resource('item','controllerItem');
Route::post('insertItem', 'controllerItem@insertItem');


