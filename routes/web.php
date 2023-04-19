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
    return view('Welcome');
})->name('Welcome');


/*Route::get('/venta', function () {
    return view('venta.index');
})->name('venta.index');*/
//Route::get('/venta', 'VentaController@index')->name('venta.index');
//Route::get('venta', [VentaController::class, 'index'])->name('venta.index');
//Route::get('venta', 'VentaController@index')->name('venta.index');
Route::get('sale', [\App\Http\Controllers\SaleController::class, 'index'])->name('sale.index');


/*Route::get('/quienes-somos', function () {
    return view('quienes-somos.index');
})->name('quienes-somos.index');*/
//Route::get('/quienes-somos', 'QuienesSomosController@index')->name('quienes-somos.index');
Route::get('about-us', [\App\Http\Controllers\AboutUsController::class, 'index'])->name('about-us.index');

/*Route::get('/contacto', function () {
    return view('contacto.index');
})->name('contacto.index');*/
//Route::get('/contacto', 'ContactoController@index')->name('contacto.index');
Route::get('contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');

