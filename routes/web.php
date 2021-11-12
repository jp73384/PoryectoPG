<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministracionController;

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
    return view('welcome');
});

Route::get('/plantilla', function(){
    return view('plantilla.master');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('Administracion')->group(function(){
    //Area
    Route::get('/RegistrarArea', [AdministracionController::class, 'RegistrarArea'])->name('RegistrarArea');
    Route::post('/guardarArea', [AdministracionController::class, 'guardarArea'])->name('guardarArea');
    Route::post('/updateArea', [AdministracionController::class, 'updateArea'])->name('updateArea');
    Route::get('/deleteArea/{id}', [AdministracionController::class, 'deleteArea'])->name('deleteArea');
    Route::get('/reloadArea', [AdministracionController::class, 'reloadArea'])->name('reloadArea');
    Route::post('/eliminarActivar', [AdministracionController::class, 'eliminarActivar'])->name('eliminarActivar');
    Route::post('/editarArea', [AdministracionController::class, 'editarArea'])->name('editarArea');

    //Empleado
    Route::get('/registerEmpleado', [AdministracionController::class, 'registerEmpleado'])->name('registerEmpleado');
    Route::post('/guadarEmpleado',  [AdministracionController::class, 'guadarEmpleado'])->name('guadarEmpleado');
    Route::get('/recargaEmpleado', [AdministracionController::class, 'recargaEmpleado'])->name('recargaEmpleado');
    Route::post('/estadoEmpleado', [AdministracionController::class, 'estadoEmpleado'])->name('estadoEmpleado');
    Route::post('/editarEmpleado', [AdministracionController::class, 'editarEmpleado'])->name('editarEmpleado');
    Route::post('/updateEmpleado', [AdministracionController::class, 'updateEmpleado'])->name('updateEmpleado');
    Route::get('/entradas', [AdministracionController::class, 'entradas'])->name('entradas');
    Route::post('/horarioEntrada', [AdministracionController::class, 'horarioEntrada'])->name('horarioEntrada');
});
