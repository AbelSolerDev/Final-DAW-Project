<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VentaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.app');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('inicio');
})->name('inicio');


/*Route::get('/venta', function () {
    return view('venta.index');
})->name('venta.index');*/
//Route::get('/venta', 'VentaController@index')->name('venta.index');
//Route::get('venta', [VentaController::class, 'index'])->name('venta.index');
//Route::get('venta', 'VentaController@index')->name('venta.index');
Route::get('venta', [\App\Http\Controllers\VentaController::class, 'index'])->name('venta.index');


/*Route::get('/quienes-somos', function () {
    return view('quienes-somos.index');
})->name('quienes-somos.index');*/
//Route::get('/quienes-somos', 'QuienesSomosController@index')->name('quienes-somos.index');
Route::get('quienes-somos', [\App\Http\Controllers\QuienesSomosController::class, 'index'])->name('quienes-somos.index');

/*Route::get('/contacto', function () {
    return view('contacto.index');
})->name('contacto.index');*/
//Route::get('/contacto', 'ContactoController@index')->name('contacto.index');
Route::get('contacto', [\App\Http\Controllers\ContactoController::class, 'index'])->name('contacto.index');

