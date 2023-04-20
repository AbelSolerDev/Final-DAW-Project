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



Route::get('sale', [\App\Http\Controllers\SaleController::class, 'index'])->name('sale.index');

Route::get('about-us', [\App\Http\Controllers\AboutUsController::class, 'index'])->name('about-us.index');

Route::get('contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');


Route::get('admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');

Route::get('admin/view-mobilhome', [\App\Http\Controllers\AdminController::class, 'viewMobilHome'])->name('admin.view-mobilhome');
Route::get('admin/new-mobilhome', [\App\Http\Controllers\AdminController::class, 'createMobilHome'])->name('admin.createMobilHome');
Route::post('/admin/new-mobilhome', 'AdminController@storeMobilHome')->name('admin.storeMobilHome');

Route::get('admin/view-user', [\App\Http\Controllers\AdminController::class, 'viewUser'])->name('admin.view-user');
Route::get('admin/new-user', [\App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.createUser');



/*
Si el usuario esta registrado podrá ver el contenido
middleware('auth')
        Route::get('profile', function () {
            // Only authenticated users may enter...
        })->middleware('auth.basic');
*/


