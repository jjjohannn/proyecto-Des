<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginCustomController;



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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('index', [UsuarioController::class, 'index'])->name('index');
Route::get('custom-registration', [App\Http\Controllers\HomeController::class, 'customRegistration'])->name('custom-registration');
Route::post('register.custom', [UsuarioController::class, 'create'])->name('register.custom');
Route::get('usuario-editList', [UsuarioController::class, 'editLista'])->middleware('auth')->name('usuario-editList');
Route::get('usuario-lista', [UsuarioController::class, 'lista'])->name('usuario-lista');
Route::get('usuario-cambiarStatus', [UsuarioController::class, 'cambiarStatus'])->name('usuario-cambiarStatus');
Route::get('usuario-edit', [UsuarioController::class, 'edit'])->name('usuario-edit');
Route::get('usuario-reinicioContr', [UsuarioController::class, 'reinicioContr'])->name('usuario-reinicioContr');
Route::get('info', [UsuarioController::class, 'info']);
