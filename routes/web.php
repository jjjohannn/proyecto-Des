<?php

use App\Http\Controllers\CarreraController;
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
Route::post('register.custom', [UsuarioController::class, 'create'])->name('register.custom');
Route::get('usuario-editList', [UsuarioController::class, 'editLista'])->name('usuario-editList');
Route::get('usuario-edit', [UsuarioController::class, 'edit'])->name('usuario-edit');
Route::get('info', [UsuarioController::class, 'info']);



Route::resource('/carreras', CarreraController::class,['middleware'=>'auth']);

Route::get('carreras',[CarreraController::class,'index'])->name('gestionCarrera');
Route::get('addCarrera',[CarreraController::class,'create'])->name('agregarCarrera');
Route::Post('storeCarrera',[CarreraController::class,'store'])->name('guardarCarrera');
Route::put('actualizarCarrera',[CarreraController::class, 'update'])->name('actualizarCarrera');
Route::get('editCarrera',[CarreraController::class,'edit'])->name('editarCarrera');

Route::get('usuario.editList', [UsuarioController::class, 'editList'])->name('usuario.editList');
Route::get('usuario.lista', [UsuarioController::class, 'lista'])->name('usuario.lista');
Route::get('usuario.cambiarStatus', [UsuarioController::class, 'cambiarStatus'])->name('usuario.cambiarStatus');

Route::get('usuario.reinicioContr', function() {
    [UsuarioController::class, 'reinicioContr'];
    return redirect('/usuario.editList');
})->name('usuario.reinicioContr');

Route::get('usuario.recuperarContr', function(){
    [UsuarioController::class, 'reinicioContr'];
    Auth::logout();
    return view('welcome');
})->name('usuario.recuperarContr');
