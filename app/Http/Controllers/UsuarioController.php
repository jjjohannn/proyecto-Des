<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Rules\FormatoRut;
use App\Rules\ValidarRut;
use App\Models\Carrera;
use Freshwork\ChileanBundle\Rut;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carreras = Carrera::all();
        $users = User::all();
        return view('usuario/index')->with('users', $users)->with('carreras', $carreras);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'rut' => ['required', 'string', 'min:8', 'unique:users', new FormatoRut(), new ValidarRut()],
            'rol' => ['required', 'string'],
        ]);

        if($request['rol'] == 1){
            $user = User::where('carrera_id', $request['carrera_id']);
            if($user->where('rol', 1)->first()){
                return back()->with('error','Un jefe de carrera ya tiene asociado esta carrera');
            }
        }

        $password = substr(Rut::parse($request['rut'])->number(), 0, 6);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($password),
            'rut' => Rut::parse($request['rut'])->normalize(),
            'status' => 1,
            'rol' => $request['rol'],
            'carrera_id' => $request['carrera_id']
        ]);

        return back()->with('success','Usuario Creado Exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carreras = Carrera::all();
        $user = User::find($id);
        return view('usuario/edit')->with('user', $user)->with('carreras', $carreras);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $count = 0;
        if($request->filled('name')){
            $request->validate(['name' => ['required', 'string', 'max:255']]);
            $name = $request['name'];
            $user->update(['name' => $name]);
            $count++;
        }
        if($request->filled('email')){
            $request->validate(['email' => ['required', 'string', 'email', 'max:255', 'unique:users']]);
            $email = $request['email'];
            $user->update(['email' => $email]);
            $count++;
        }
        if($request->filled('rut')){
            $request->validate(['rut' => ['required', 'string', 'min:8', 'unique:users', new FormatoRut(), new ValidarRut()]]);
            $rut = $request['rut'];
            $user->update(['rut' => $rut]);
            $count++;
        }
        if($request->filled('rol')){
            $request->validate(['rol' => ['required', 'string']]);
            $rol = $request['rol'];
            $user->update(['rol' => $rol]);
            $count++;
        }


        if($request->filled('carrera_id')){
            $request->validate(['carrera_id' => ['required', 'string']]);

            //TODO: Validar que no haya un jefe de carrera registrado con la id de carrera ingresada en el editar
            /*if($user->rol == 1){
                //$a = User::all();
                //$userExist = User::where('carrera_id', $user['carrera_id'])->where('rol', 1);
                //if($a->where('carrera_id', '=', $request['carrera_id'])->where('rol', '=', 1)){
                if(DB::table('users')->where('carrera_id', '=', $request['carrera_id'])->orWhere('rol', '=', 1)){
                    return back()->with('error', 'Un jefe de carrera ya está asociado a esta carrera');
                }else{
                    dd('a');
                }
                /*if($userExist->where('rol', 1)->first()){
                }
            }*/

            if($user->status !== 0){
                $carrera_id = $request['carrera_id'];
                $user->update(['carrera_id' => $carrera_id]);
                $count++;
            }else{
                return back()->with('error', 'Este usuario está deshabilitado');
            }

        }

        if($count > 0){
            $user->save();
            return back()->with('success','Usuario Editado Exitosamente!');
        }else{
            return back()->with('error','Datos no ingresados!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function editList(){
        $users = User::all();
        return view('usuario/editList');
    }

    public function editor(Request $request){
        $user = User::where('rut', '=', $request->input('rut'))->first();
        return $user;
    }

    public function lista(Request $request){

        if ($request->search == null) {
            $users = User::simplePaginate(5);
            return view('usuario.editUser')->with('users', $users);
        }else {
            $users = User::where('rut', $request->search)->simplePaginate(1);
            return view('usuario.editUser')->with('users', $users);
        }

    }

    public function cambiarStatus(Request $request){

        $usuario = User::where('id', $request->id)->get()->first();
        if ($usuario->status === 0) {
            $usuario->status = 1;
            $usuario->save();
            return back()->with('success', 'Usuario Habilitado exitosamente!');
        }else {
            $usuario->status = 0;
            $usuario->save();
            return back()->with('success', 'Usuario Deshabilitado exitosamente!');
        }
    }

    public function reinicioContr(Request $request){
        $usuario = User::where('id', $request->id)->get()->first();
        $password = substr(Rut::parse($usuario['rut'])->number(), 0, 6);
        $usuario->update(['password' => Hash::make($password)]);
        if($usuario->rol == 0){
            Auth::logout();
            return redirect('/home');
        }else{
            return back()->with('success', 'Contraseña reestablecida exitosamente!');
        }
    }

    public function nuevaClave(Request $request){
        $user = Auth::user();
        $currentUser = User::where('rut', $user->rut)->get()->first();
        $request->validate(['password' => ['required', 'string', 'min:6', 'confirmed']]);
        $stringPassword = $request['password'];
        if(is_numeric($stringPassword)){
            if (password_verify($request['previous-password'], $currentUser->password)) {
                $newPassword = $request['password'];
                $currentUser->update(['password' => Hash::make($newPassword)]);
                return back()->with('success', 'Cambio Exitoso.');
            }else{
                return back()->with('error', 'La clave anterior no coincide con nuestras credenciales.');
            }
        }else{
            return back()->with('error', 'La nueva clave deben ser dígitos.');
        }
    }
}
