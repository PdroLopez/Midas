<?php

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

Route::prefix('payments')->group(function() {
    Route::get('/', 'PaymentsController@index');
Route::get('/gateway/webpay/transaction/{transactionId}', 'WebpayController@transaction')->name('gateway.webpay.transaccion');
Route::post('/gateway/webpay/response/{transactionId}', 'WebpayController@response')->name('gateway.webpay.response');
Route::post('/gateway/webpay/finish/{transactionId}', 'WebpayController@finish')->name('gateway.webpay.finish');
Route::get('/gateway/webpay/addcard/{tarjetaCodigo}', 'WebpayController@addcard')->name('gateway.webpay.addcard');
Route::post('/gateway/webpay/responsecard/{tarjetaCodigo}', 'WebpayController@responseCard')->name('gateway.webpay.responseCard');
// Route::get('compra/return/{transaccionId}', 'TiendaController@responseTransaccion');        
//WIP se debe corregir luego de la reunion

Route::get('/gateway/webpay/finish/tienda/compra/return/{transaction_id}', 'PaymentsController@responseTransaccion')->name('gateway.webpay.finish.tienda');
Route::post('/gateway/webpay/finish/tienda/compra/return/{transaction_id}', 'PaymentsController@responseTransaccion')->name('gateway.webpay.finish.tienda');





# Transaccion Completa
Route::get('/transaccion_completa/create', function () {
    return view('transaccion_completa/create');
});

Route::post('/transaccion_completa/create', 'TransaccionCompletaController@createTransaction');

Route::post('/transaccion_completa/installments', 'TransaccionCompletaController@installments');

Route::get('/transaccion_completa/transaction_commit', function () {
    return view('transaccion_completa/transaction_commit');
});

Route::post('/transaccion_completa/transaction_commit', 'TransaccionCompletaController@commit');

Route::get('/transaccion_completa/transaction_status', function () {
    return view('transaccion_completa/transaction_status');
});

Route::post('/transaccion_completa/transaction_status', 'TransaccionCompletaController@status');

Route::post('/transaccion_completa/refund', 'TransaccionCompletaController@refund');










});



// Route::post('/gateway/webpay/response/{transactionId}', 'WebpayController@response')->name('gateway.webpay.response');

