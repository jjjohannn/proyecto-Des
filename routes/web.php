<?php

use App\Http\Controllers\BuscarEstudianteController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\ResolverSolicitudController;
use App\Http\Controllers\SolicitudController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsersImportController;
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
    return view('/auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
#################################################USUARIO#################################################

//Admin
Route::middleware(['rutasAdmin'])->group(function () {
    Route::get('registro', [App\Http\Controllers\HomeController::class, 'customRegistration'])->name('custom-registration');
    Route::get('ListaUsuarios', [UsuarioController::class, 'editList'])->name('usuario.editList');
    Route::get('Lista', [UsuarioController::class, 'lista'])->name('usuario.lista');
    Route::get('EditarUsuario', function(){
        return view('usuario/editUser');
    })->name('usuario.editUser');
    Route::get('cambiarStatus', [UsuarioController::class, 'cambiarStatus'])->name('usuario.cambiarStatus');
    Route::get('reinicioClave', [UsuarioController::class, 'reinicioContr'])->name('usuario.reinicioContr');
});

//Alumno
Route::middleware(['rutasAlumno'])->group(function () {
    Route::resource('solicitud', SolicitudController::class);
});

//Jefe de Carrera
Route::middleware(['rutasJefeCarrera'])->group(function () {
    Route::resource('resolverSolicitud', ResolverSolicitudController::class);
    Route::get('buscar-estudiante', function(){return view('buscar-estudiante.index');})->name('buscarEstudiante');
    Route::post('alumno',[BuscarEstudianteController::class, 'devolverEstudiante'])->name('postBuscarEstudiante');
    Route::get('alumno/{id}', [BuscarEstudianteController::class,'mostrarEstudiante'])->name('mostrarEstudiante');
    Route::get('alumno/{idAlumno}/solicitud/{idSolicitud}', [BuscarEstudianteController::class, 'verDatosSolicitud'])->name('verSolicitudAlumno');
    Route::get('resolver', [ResolverSolicitudController::class, 'index'])->name('resolver');
    Route::get('alumno/{idAlumno}/solicitud/{idSolicitud}', [BuscarEstudianteController::class, 'datos'])->name('informacion');
});

//General
Route::resource('usuario', UsuarioController::class,['middleware' => 'auth']);
Route::post('nuevaClave', [UsuarioController::class, 'nuevaClave'])->name('usuario.nuevaClave');
Route::get('cambiarClave', function(){
    return view('usuario/changePassword');
})->name('cambiarClave');
##################################################################################################

#################################################CARRERA#################################################
Route::resource('/carreras', CarreraController::class,['middleware'=>'auth']);

Route::get('carreras',[CarreraController::class,'index'])->name('gestionCarrera');
Route::get('addCarrera',[CarreraController::class,'create'])->name('agregarCarrera');
Route::Post('storeCarrera',[CarreraController::class,'store'])->name('guardarCarrera');
Route::put('actualizarCarrera',[CarreraController::class, 'update'])->name('actualizarCarrera');
Route::get('editCarrera',[CarreraController::class,'edit'])->name('editarCarrera');


Route::get('/users/import', [UsersImportController::class, 'show']);
Route::post('/users/import', [UsersImportController::class, 'store'])->name('cargaMasiva');
