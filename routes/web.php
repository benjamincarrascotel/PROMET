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

//INVENTARIO
Route::get('/inventario/{id}', 'ActivoController@cambio_fase_create_view')->name('inventario.cambio_fase_create');

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

        //ACTIVOS
        Route::get('/activo/trazabilidad', 'ActivoController@trazabilidad')->name('activo.trazabilidad');
        Route::get('/activo/baja_activo/{id}', 'ActivoController@baja_activo_create')->name('activo.baja_activo_create');
        Route::post('/activo/baja_activo_store', 'ActivoController@baja_activo_store')->name('activo.baja_activo_store');
        Route::get('/activo/reportes', 'ActivoController@reportes')->name('activo.reportes');
        Route::post('/activo/carga_masiva', 'ActivoController@carga_masiva')->name('activo.carga_masiva');

        Route::get('/trazabilidad/datatable', 'ActivoController@trazabilidad_datatable')->name('trazabilidad.datatable');
        Route::get('/reportes/datatable', 'ActivoController@reportes_datatable')->name('reportes.datatable');

        Route::post('/reportes/exportar', 'ActivoController@reportes_exportar')->name('reportes.exportar');


        //ARRIENDOS
        Route::get('/arriendo/create/{id}', 'ArriendoController@create')->name('arriendo.create');
        Route::post('/arriendo/store', 'ArriendoController@store')->name('arriendo.store');
        Route::get('/arriendo/show/{id}', 'ArriendoController@show')->name('arriendo.show');
        Route::post('/arriendo/update/{id}', 'ArriendoController@update')->name('arriendo.update');
        Route::post('/arriendo/carga_masiva', 'ArriendoController@carga_masiva')->name('arriendo.carga_masiva');

        //TRASPASOS
        Route::get('/traspaso/{id}', 'TraspasoController@traspaso_arriendo_create')->name('traspaso.create');
        Route::get('/traspaso_venta/{id}', 'TraspasoController@traspaso_venta_create')->name('traspaso_venta.create');
        Route::post('/traspaso/store', 'TraspasoController@traspaso_store')->name('traspaso.store');

        //MANTENCIONES
        Route::post('/mantencion/finish', 'MantencionController@finish')->name('mantencion.finish');

        //VENTAS
        Route::get('/venta/create/{id}', 'VentaController@create')->name('venta.create');
        Route::post('/venta/store', 'VentaController@store')->name('venta.store');
        Route::get('/venta/show/{id}', 'VentaController@show')->name('venta.show');
        Route::post('/venta/update/{id}', 'VentaController@update')->name('venta.update');
        Route::post('/venta/carga_masiva', 'VentaController@carga_masiva')->name('venta.carga_masiva');

        //PROYECTOS
        Route::get('/proyecto/index', 'ProyectoController@index')->name('proyecto.index');
        Route::get('/proyecto/create', 'ProyectoController@create')->name('proyecto.create');
        Route::post('/proyecto/store', 'ProyectoController@store')->name('proyecto.store');
        Route::get('/proyecto/cambio_estado', 'ProyectoController@cambio_estado')->name('proyecto.cambio_estado');
        Route::get('/proyecto/destroy', 'ProyectoController@destroy')->name('proyecto.destroy');


        Route::resource('usuarios', 'UserController')->only([
            'create', 'store', 'edit','update','index',
        ]);


        
    });

    

    Route::group(['middleware' => ['bodega']], function () {

        //TRANSPORTE
        Route::get('/transporte', 'TransporteController@transporte')->name('arriendo.transporte');
        Route::post('/transporte/cambio_fase', 'TransporteController@cambio_fase')->name('transporte.cambio_fase');
        Route::get('/transporte/qr_reader/{id}', 'TransporteController@qr_reader')->name('transporte.qr_reader');
        Route::get('/transporte/datatable', 'TransporteController@transporte_datatable')->name('transporte.datatable');

        //ACTIVOS
        Route::get('/activo/create', 'ActivoController@create')->name('activo.create');
        Route::post('/activo/store', 'ActivoController@store')->name('activo.store');
        Route::post('/activo/update/{id}', 'ActivoController@update')->name('activo.update');
        Route::get('/activo/index', 'ActivoController@index')->name('activo.index');
        Route::get('/activo/show/{id}', 'ActivoController@show')->name('activo.show');

        //MANTENCIONES
        Route::get('/mantencion/create/{id}', 'MantencionController@create')->name('mantencion.create');
        Route::post('/mantencion/store', 'MantencionController@store')->name('mantencion.store');


    });

    
});