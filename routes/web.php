<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UsuarioController;



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

Route::resource('usuario', UsuarioController::class,['middleware' => 'auth']);
Route::get('custom-registration', [App\Http\Controllers\HomeController::class, 'customRegistration'])->name('custom-registration');
Route::get('usuario.editList', [UsuarioController::class, 'editList'])->name('usuario.editList');


/*Route::get('index', [UsuarioController::class, 'index'])->name('index');
Route::post('register.custom', [UsuarioController::class, 'create'])->name('register.custom');
Route::get('usuario-edit', [UsuarioController::class, 'edit'])->name('usuario-edit');
Route::put('usuario-editado', [UsuarioController::class, 'update'])->name('usuario-editado');
Route::get('info', [UsuarioController::class, 'info']);*/
