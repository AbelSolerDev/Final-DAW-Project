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


/*SECCIÓN DE VENTAS*/
Route::get('sale', [\App\Http\Controllers\SaleController::class, 'index'])->name('sale.index');
Route::get('sale/{mobilHome}', [\App\Http\Controllers\SaleController::class, 'show'])->name('sale.show');

/*SECCIÓN DE SOBRE NOSOTROS*/
Route::get('about-us', [\App\Http\Controllers\AboutUsController::class, 'index'])->name('about-us.index');

/*SECCIÓN DE CONTACTO*/
Route::get('contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');

/*SECCIÓN DE ADMINITRACIÓN*/
Route::get('admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');

    /*ADMINITRACIÓN MOBILHOME*/
Route::get('admin/view-mobilhome', [\App\Http\Controllers\AdminController::class, 'viewMobilHome'])->name('admin.view-mobilhome');
Route::get('admin/new-mobilhome', [\App\Http\Controllers\AdminController::class, 'createMobilHome'])->name('admin.createMobilHome');
Route::post('/admin/view-mobilhome', [\App\Http\Controllers\AdminController::class, 'storeMobilHome'])->name('admin.storeMobilHome');
Route::get('/admin/edit-mobilhome/{id}', [\App\Http\Controllers\AdminController::class, 'updateMobilHome'])->name('admin.updateMobilHome');
Route::put('/admin/edit-mobilhome/{id}', [\App\Http\Controllers\AdminController::class, 'editMobilHome'])->name('admin.editMobilHome');
Route::delete('/admin/mobilhome/{id}', [\App\Http\Controllers\AdminController::class, 'deleteMobilHome'])->name('admin.deleteMobilHome');



    /*ADMINITRACIÓN USUARIOS*/
Route::match(['get', 'delete'], '/admin/view-user', 'App\Http\Controllers\AdminController@viewUser')->name('admin.view-user');
Route::get('admin/new-user', [\App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.createUser');
Route::post('/admin/new-user', 'App\Http\Controllers\AdminController@storeUser')->name('admin.storeUser');
Route::get('/admin/edit-user/{id}', 'App\Http\Controllers\AdminController@editUser')->name('admin.editUser');
Route::put('/admin/edit-user/{id}', 'App\Http\Controllers\AdminController@updateUser')->name('admin.updateUser');
Route::delete('/admin/delete-user/{id}', 'App\Http\Controllers\AdminController@deleteUser')->name('admin.deleteUser');

/*SECCIÓN DE MI CUENTA*/

Route::get('myaccount', [\App\Http\Controllers\MyAccountController::class, 'index'])->name('myaccount.index');
Route::get('/myaccount/edit', [\App\Http\Controllers\MyAccountController::class, 'editUser'])->name('myaccount.edit');
Route::delete('/myaccount/delete', [\App\Http\Controllers\MyAccountController::class, 'deleteUser'])->name('myaccount.delete');



/*
Si el usuario esta registrado podrá ver el contenido
middleware('auth')
        Route::get('profile', function () {
            // Only authenticated users may enter...
        })->middleware('auth.basic');
*/


