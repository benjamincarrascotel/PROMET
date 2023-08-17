<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false]);

//ALERTA
Route::post('/contrato/enviar_alerta', 'ContratoController@enviar_alerta')->middleware(['superadmin'])->name('contrato.enviar_alerta');

// PROVEEDOR
Route::get('/proveedor/create', 'ProveedorController@create')->name('proveedor.create');
Route::post('/proveedor/store', 'ProveedorController@store')->name('proveedor.store');
Route::post('/proveedor/store2', 'ProveedorController@store2')->name('proveedor.store2');


Route::group(['middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/admin', 'AdminController@index')->name('admin.index');
    Route::get('/superadmin/{flag}', 'SuperAdminController@index')->middleware(['superadmin'])->name('superadmin.index');

    //PROVEEDOR
    Route::get('/proveedor/index', 'ProveedorController@index')->name('proveedor.index');
    Route::get('/proveedor/{id}', 'ProveedorController@show')->name('proveedor.show');

    Route::group(['middleware' => ['superadmin']], function () {

        //DASHBOARD
        Route::get('/contrato/detalles', 'ContratoController@detalles')->name('contrato.detalles');
        Route::get('/contrato/plan', 'ContratoController@plan')->name('contrato.plan');
        Route::get('/contrato/fechas', 'ContratoController@fechas')->name('contrato.fechas');
        Route::get('/contrato/cronograma', 'ContratoController@cronograma')->name('contrato.cronograma');
        Route::get('/contrato/kpis', 'ContratoController@kpis')->name('contrato.kpis');

        //FASES CONTRATO
        Route::get('/contrato/create_fase_proyectada', 'ContratoController@create_fase_proyectada')->name('fase.create_fase_proyectada');
        Route::post('/contrato/store_fase_proyectada', 'ContratoController@store_fase_proyectada')->name('fase.store_fase_proyectada');
        
        //CONTRATO
        Route::get('/contrato/create', 'ContratoController@create')->name('contrato.create');
        Route::post('/contrato/store', 'ContratoController@store')->name('contrato.store');
        Route::get('/contrato/{id}', 'ContratoController@show')->name('contrato.show');

        Route::post('/contrato/{id}/fase/update', 'ContratoController@fase_update')->name('fase.update');
        Route::post('/contrato/excel', 'ContratoController@excel')->name('contrato.excel');
        Route::post('/contrato/axis_update', 'ContratoController@axis_update')->name('contrato.axis_update');

        //USERS
        Route::get('/usuarios/destroy/{id}', 'UserController@destroy')->name('usuarios.destroy');
        Route::get('/usuarios/{id}', 'UserController@create')->name('usuarios.create');
        Route::post('/usuarios/store', 'UserController@store')->name('usuarios.store');



        Route::resource('usuarios', 'UserController')->only([
            'create', 'store', 'edit','update','index',
        ]);


        
    });
    
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    
});