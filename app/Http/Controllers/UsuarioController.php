<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Rules\FormatoRut;
use App\Rules\ValidarRut;

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
        return view('usuario.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rut' => ['required', 'string', 'min:8', 'unique:users', new FormatoRut(), new ValidarRut()],
            'rol' => ['required', 'string'],
        ]);

        $check = $this->store($request);

        return back()->with('success','Usuario Creado Exitosamente!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkbox = isset($request['status']) ? 1 : 0;
        $password = substr(Rut::parse($request['rut'])->number(), 0, 6);

        if($checkbox === 1){
            return User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                //'password' => Hash::make($request['password']),
                'password' => Hash::make($password),
                'rut' => Rut::parse($request['rut'])->normalize(),
                'status' => 1,
                'rol' => $request['rol'],
            ]);

        }else{
            return User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                //'password' => Hash::make($request['password']),
                'password' => Hash::make($password),
                'rut' => Rut::parse($request['rut'])->normalize(),
                'status' => 0,
                'rol' => $request['rol'],
            ]);
        }
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
        //
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
        //
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

    public function editLista(){

        $users = User::all();
        return view('usuario.editList')->with('users', $users);
    }

    public function editor(Request $request){

        $users = User::where('rut', '=', $request->input('rut'))->first();
        return view('usuario.edit')->with('users', $users);
    }

}
