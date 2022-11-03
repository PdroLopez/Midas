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
Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('login')->group(function() {
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('/', 'Auth\LoginController@login');
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');

	// Registration Routes...
	Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    //Select Dinamico
    // Route::get('register', 'SelectController@getRegiones')->name('register');

	// Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@resetPassword')->name('password.update');
	//home 
	//rutas socialite
	Route::get('/sing-in/{provider}','Auth\LoginController@facebook');
	Route::get('/sing-in/{provider}/redirect','Auth\LoginController@facebookRedirect');
	//instagram api
	Route::get('/instagram','Auth\LoginController@redirectToInstagramProvider');

	Route::get('/instagram/callback', 'Auth\LoginController@instagramProviderCallback');
	//pasos registrar usuario
	Route::prefix('register')->group(function(){
		Route::post('/paso-2','Auth\RegisterController@paso_2');
		Route::post('/usuario/paso-3','Auth\RegisterController@userPaso_3');
		Route::post('/usuario/paso-4','Auth\RegisterController@userPaso_4');
		Route::post('/usuario/paso-5','Auth\RegisterController@userPaso_5');
		//pasos registrar empresa
		Route::post('/empresa/paso-3','Auth\RegisterController@empresaPaso_3');
		Route::post('/agregar-user','Auth\LoginController@registro_socialite');
		Route::post('/agregar-user-instagram','Auth\LoginController@registro_instagram');
		//vista de numero
		Route::get('login-telefono','Auth\LoginController@login_telefono');
		//envio codigo
		Route::post('/telefono','Auth\LoginController@codigo_verificacion');
		//comparacion
		Route::post('/telefono-codigo','Auth\LoginController@telefono_codigo');
		Route::post('/agregar-user-phone','Auth\LoginController@phone_register');
	});
});
