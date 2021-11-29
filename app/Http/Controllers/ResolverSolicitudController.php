<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ResolverSolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carreraJefeCarrera = Auth::user()->carrera_id;
        //dd($carreraJefeCarrera);
        $alumnoConSolicitud = User::whereHas(
            'solicitudes', function($q){
                $q->where('estado', 0);
            }
        )->with('solicitudes')->get();


        $aux = 0;
        foreach($alumnoConSolicitud as $key){
            if($key->carrera_id == $carreraJefeCarrera){
                $aux++;
            }
        }

        return view('solicitud.resolver')->with('alumnos', $alumnoConSolicitud)->with('aux', $aux);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = User::where('id', '=', $request['alumno'])->first();
        if($request['value'] == 1){
            $user->solicitudes()->wherePivot('id', $request['solicitud'])->updateExistingPivot(1, [
                'estado' => 1
            ]);
            $user->save();
            return back()->with('success','Usuario Editado Exitosamente!');
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
}
