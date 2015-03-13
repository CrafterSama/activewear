<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*App::missing(function($exception)
{
	return Response::view('errors.error404');
});*/

/** Home Links **/
Route::pattern('id', '[0-9]+');
Route::pattern('model', '[a-zA-Z-]+');

Route::get('/', 'HomeController@index');


Route::get('productos', 'HomeController@showProducts');

Route::get('productos/carioca', 'HomeController@showProductsCarioca');

Route::get('productos/pioggia', 'HomeController@showProductsPioggia');

Route::get('productos/modelos/short', 'HomeController@showShorts');

Route::get('productos/modelos/{id}/{name}', 'HomeController@showModels');

Route::get('productos/pioggia/modelos/{id}/{name}', 'HomeController@showModelsPioggia');

Route::get('productos/carioca/modelos/{id}/{name}', 'HomeController@showModelsCarioca');

Route::get('productos/modelos/ninas', 'HomeController@showNinas');

Route::get('productos/modelos/capri', 'HomeController@showCapri');

Route::get('productos/modelos/largo', 'HomeController@showLargo');

Route::get('productos/modelos/largo-venezuela', 'HomeController@showLargoVenezuela');

Route::get('productos/modelos/falda-short', 'HomeController@showFaldaShort');

Route::get('productos/modelos/semi-body', 'HomeController@showSemiBody');


Route::get('productos/ver/{id}/{title?}', 'HomeController@showProductProfile');

Route::get('acerca-de', 'HomeController@showAbout');

Route::get('contactos', 'HomeController@showContact');

Route::get('galerias', 'HomeController@showGaleries');

Route::get('galerias/desfiles', 'HomeController@showGalerie1');

Route::get('galerias/sesiones', 'HomeController@showGalerie2');

Route::get('galerias/eventos', 'HomeController@showGalerie3');

Route::get('galerias/sesiones/brasil-2014', 'HomeController@showBrasil2014');

Route::get('galerias/sesiones/maracaibo-2014', 'HomeController@showDunas2014');

Route::get('login', 'AuthController@showLogin');

Route::post('login', 'AuthController@postLogin');

Route::get('registrarse', 'UsersController@showRegister');

Route::post('registrarse', 'UsersController@postRegister');

Route::get('/api/dropdown/{id}', 'UsersController@cities');

Route::group(array('before' => 'auth'), function()
{

	Route::post('cesta/agregar', 'OrdersController@agreeBasket');
	Route::post('cesta/actualizar/{id}', 'OrdersController@updateBasket');
	Route::get('cesta', 'OrdersController@showBasket');

	Route::get('logout', 'AuthController@logOut');

	Route::get('admin', 'AdminController@showPanel');
	Route::group(['prefix' => 'admin'], function() {
		
		/** Admin Links **/
		Route::get('productos', 'ProductsController@index');
		Route::get('productos/agregar', 'ProductsController@create');
		Route::post('productos/agregar', 'ProductsController@store');
		Route::get('productos/{id}/editar', 'ProductsController@edit');
		Route::post('productos/{id}/editar', 'ProductsController@update');
		Route::get('productos/borrar/{id}', 'ProductsController@destroy');
		
		Route::get('estampados', 'StampsController@index');
		Route::get('estampados/{id}/editar', 'StampsController@edit');
		Route::post('estampados/{id}/editar', 'StampsController@update');

		Route::get('modelos', 'ModelosController@index');
		Route::get('modelos/agregar', 'ModelosController@create');
		Route::post('modelos/agregar', 'ModelosController@store');
		Route::get('modelos/{id}/editar', 'ModelosController@edit');
		Route::post('modelos/{id}/editar', 'ModelosController@update');
		Route::get('modelos/borrar/{id}', 'ModelosController@destroy');
		
		Route::get('usuarios', 'UsersController@index');
		Route::get('usuarios/baneados', 'UsersController@bannedUsers');
		Route::get('usuarios/{id}/restaurar', 'UsersController@restoreUser');
		Route::get('usuarios/agregar', 'UsersController@create');
		Route::post('usuarios/agregar', 'UsersController@store');
		Route::get('usuarios/{id}/editar', 'UsersController@edit');
		Route::post('usuarios/{id}/editar', 'UsersController@update');
		Route::get('usuarios/{id}/password', 'UsersController@password');
		Route::post('usuarios/{id}/password', 'UsersController@changePassword');
		Route::get('usuarios/borrar/{id}', 'UsersController@destroy');
		Route::get('usuarios/{id}/perfil', 'UsersController@showProfile');
		Route::get('usuarios/{id}/pedidos', 'UsersController@showOrders');
		
		Route::get('pedidos', 'OrdersController@index');
		Route::get('pedidos/aprobados', 'OrdersController@approved');
		Route::get('pedidos/enviados', 'OrdersController@shipped');
		Route::get('pedidos/aprobar/{id}', 'OrdersController@approveOrder');
		Route::get('pedidos/enviado/{id}', 'OrdersController@shippedOrder');
		Route::get('pedidos/quitar/{id}', 'OrdersController@cancelOrder');
		Route::get('pedidos/cancelar/{id}', 'OrdersController@cancelAllOrder');

		Route::get('reportes/por-fecha', 'ReportsController@getDates');
		Route::get('reportes/por-porcentaje', 'ReportsController@getPorcentual');
		
		Route::get('configuracion', 'ConfigurationsController@edit');
		Route::post('configuracion', 'ConfigurationsController@update');

		Route::controller('users', 'UsersController');
		Route::controller('products', 'ProductsController');
		Route::controller('modelos', 'ModelosController');

	});

Route::get('/orders', ['uses' => 'CartController@get_orders'] );
Route::get('/order/{id}', ['uses' => 'CartController@get_order'] );
Route::get('/order/{id}/borrar', ['uses' => 'CartController@deleteOrder'] );
Route::post('/pay', ['uses' => 'CartController@post_pay'] );

Route::get('/procesar', ['uses' => 'CartController@get_procesar'] );

});

/* CART */
Route::get('/cart', ['uses' => 'CartController@get_cart'] );
Route::get('/cart/remove/{rowid}', ['uses' => 'CartController@get_removeitem'] );
Route::post('/cart/{id}/add/{qty}', ['uses' => 'CartController@post_add'] );
Route::get('/cart/minus/{rowid}', ['uses' => 'CartController@post_minus'] );
Route::get('/cart/plus/{rowid}', ['uses' => 'CartController@post_plus'] );




Route::get('/factura/{slug}', ['uses' => 'CartController@get_factura'] );

Route::get('/carrito', function()
{
	$cart = Cart::content();
	return View::make('home.carrito', array('cart' => $cart )); 
});

Route::post('/total', function()
{
	echo '<span class="label label-warning cart-text">'.Cart::count().'</span>&nbsp;&nbsp;';
});


Route::get('/assets/images/pays/{slug}', function($slug){
	return Response::download('assets/images/pays/'.$slug);
});


/*
	GEOLOCALITATION API
*/
Route::post('/geo/estados', function()
{
	echo Estado::orderBy('estado', 'ASC')->get()->toJson();
});
Route::post('/geo/estado/{id}', function($id)
{
	echo Estado::find($id)->ciudades->toJson();
});

/* *********** */