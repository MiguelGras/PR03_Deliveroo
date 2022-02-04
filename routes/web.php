<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestauranteController;

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


/*Mostrar vista clientes*/
Route::get('/vistaclientes',[RestauranteController::class,'vistaCliente']);

/* MOSTRAR */
Route::get('/mostrar',[RestauranteController::class, 'mostrarRestaurante']);

/* ELIMINAR */
Route::delete('/eliminarRestaurante/{id}', [RestauranteController::class, 'eliminarRestaurante']);

/* CREAR */
Route::get('/crear',[RestauranteController::class, 'crearRestaurante']);

Route::post('/crear',[RestauranteController::class, 'crearRestaurantePost']);

/* MODIFICAR */
Route::get('/modificarRestaurante/{id}', [RestauranteController::class, 'modificarRestaurante']);

Route::put('/modificarRestaurante',[RestauranteController::class, 'modificarRestaurantePut']);

