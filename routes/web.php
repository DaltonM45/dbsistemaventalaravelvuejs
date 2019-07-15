<?php

// ****************** ANTES  SIN MIDDLEWARE ******************
// Route::get('/main', function () {
//     return view('contenido/contenido');
// })->name('main');

// //rutas categoria
// Route::get('/categoria', 'CategoriaController@index');
// Route::post('/categoria/registrar', 'CategoriaController@store');
// Route::put('/categoria/actualizar', 'CategoriaController@update');
// Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
// Route::put('/categoria/activar', 'CategoriaController@activar');
// Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');

// //rutas user
// Route::get('/articulo', 'ArticuloController@index');
// Route::post('/articulo/registrar', 'ArticuloController@store');
// Route::put('/articulo/actualizar', 'ArticuloController@update');
// Route::put('/articulo/desactivar', 'ArticuloController@desactivar');
// Route::put('/articulo/activar', 'ArticuloController@activar');


// //rutas cliente
// Route::get('/cliente', 'ClienteController@index');
// Route::post('/cliente/registrar', 'ClienteController@store');
// Route::put('/cliente/actualizar', 'ClienteController@update');



// //rutas proveedor
// Route::get('/proveedor', 'ProveedorController@index');
// Route::post('/proveedor/registrar', 'ProveedorController@store');
// Route::put('/proveedor/actualizar', 'ProveedorController@update');


// //rutas roles
// Route::get('/rol', 'RolController@index');
// Route::get('/rol/selectRol' , 'RolController@selectRol');


// //rutas user
// Route::get('/user', 'UserController@index');
// Route::post('/user/registrar', 'UserController@store');
// Route::put('/user/actualizar', 'UserController@update');
// Route::put('/user/desactivar', 'UserController@desactivar');
// Route::put('/user/activar', 'UserController@activar');

// //Auth::routes();

// //rutas de login
// Route::get('/', 'Auth\LoginController@showLoginForm');
// Route::post('/login', 'Auth\LoginController@login')->name('login');

// Route::get('/home', 'HomeController@index')->name('home');


//*********************** */AHORA CON MIDDLEWARE

//rutas para las personas que no se han autenticado
Route::group(['middleware' => ['guest']] , function(){

    //rutas de login, 
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    
});


//rutas para las personas que se han autenticado
Route::group(['middleware' => ['auth']] , function(){

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');


    //rutas para almaceneros
Route::group(['middleware' => ['Almacenero']] , function(){


    //rutas categoria
    Route::get('/categoria', 'CategoriaController@index');
    Route::post('/categoria/registrar', 'CategoriaController@store');
    Route::put('/categoria/actualizar', 'CategoriaController@update');
    Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
    Route::put('/categoria/activar', 'CategoriaController@activar');
    Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');

    //rutas user
    Route::get('/articulo', 'ArticuloController@index');
    Route::post('/articulo/registrar', 'ArticuloController@store');
    Route::put('/articulo/actualizar', 'ArticuloController@update');
    Route::put('/articulo/desactivar', 'ArticuloController@desactivar');
    Route::put('/articulo/activar', 'ArticuloController@activar');

    //rutas proveedor
    Route::get('/proveedor', 'ProveedorController@index');
    Route::post('/proveedor/registrar', 'ProveedorController@store');
    Route::put('/proveedor/actualizar', 'ProveedorController@update');

});


    Route::group(['middleware' => ['Vendedor']] , function(){

            //rutas cliente
            Route::get('/cliente', 'ClienteController@index');
            Route::post('/cliente/registrar', 'ClienteController@store');
            Route::put('/cliente/actualizar', 'ClienteController@update');
        
    });


    Route::group(['middleware' => ['Administrador']] , function(){

            //rutas categoria
            Route::get('/categoria', 'CategoriaController@index');
            Route::post('/categoria/registrar', 'CategoriaController@store');
            Route::put('/categoria/actualizar', 'CategoriaController@update');
            Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
            Route::put('/categoria/activar', 'CategoriaController@activar');
            Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');

            //rutas user
            Route::get('/articulo', 'ArticuloController@index');
            Route::post('/articulo/registrar', 'ArticuloController@store');
            Route::put('/articulo/actualizar', 'ArticuloController@update');
            Route::put('/articulo/desactivar', 'ArticuloController@desactivar');
            Route::put('/articulo/activar', 'ArticuloController@activar');

            //rutas proveedor
            Route::get('/proveedor', 'ProveedorController@index');
            Route::post('/proveedor/registrar', 'ProveedorController@store');
            Route::put('/proveedor/actualizar', 'ProveedorController@update');

            //rutas cliente
            Route::get('/cliente', 'ClienteController@index');
            Route::post('/cliente/registrar', 'ClienteController@store');
            Route::put('/cliente/actualizar', 'ClienteController@update');

            //rutas roles
            Route::get('/rol', 'RolController@index');
            Route::get('/rol/selectRol' , 'RolController@selectRol');

            //rutas user
            Route::get('/user', 'UserController@index');
            Route::post('/user/registrar', 'UserController@store');
            Route::put('/user/actualizar', 'UserController@update');
            Route::put('/user/desactivar', 'UserController@desactivar');
            Route::put('/user/activar', 'UserController@activar');

    });

    
});
    