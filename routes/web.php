<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EscuelaController;
use App\Http\Controllers\FacturaController;
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
Route::get('usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::resource('usuarios', UsuarioController::class);


Route::get('facturas/{id}/xml', [FacturaController::class, 'generateXML'])->name('facturas.xml');
Route::get('facturas/pdf/{id}', [FacturaController::class, 'pdf'])->name('facturas.pdf');
Route::get('usuarios/{id}/pdf', [UsuarioController::class, 'pdf'])->name('usuarios.pdf');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('facturas', FacturaController::class);


//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('escuelas', EscuelaController::class);
});
