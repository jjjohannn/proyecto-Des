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
        $alumnos = User::whereHas(
            'solicitudes'
        )->with('solicitudes')->get();
<<<<<<< HEAD
        $alumno = User::whereHas(
            'solicitudes'
        )->with('solicitudes')->get();
        $aux = 0;
        foreach($alumnoConSolicitud as $key){
            if($key->carrera_id == $carreraJefeCarrera){
                $aux++;
            }
        }

        return view('solicitud.resolver')->with('alumnos', $alumno)->with('aux', $aux);
=======

        $aux_Pendiente = 0;
        $aux_Aceptada = 0;
        $aux_Observacion = 0;
        $aux_Rechazada = 0;
        $aux_Negada = 0;
        foreach($alumnos as $alumno){
            foreach($alumno->solicitudes as $solicitud){
                if($solicitud->pivot->estado == 0 and $alumno->carrera_id == Auth::user()->carrera_id){
                   $aux_Pendiente++;
                }
                if($solicitud->pivot->estado == 1 and $alumno->carrera_id == Auth::user()->carrera_id){
                    $aux_Aceptada++;
                }
                if($solicitud->pivot->estado == 2 and $alumno->carrera_id == Auth::user()->carrera_id){
                    $aux_Observacion++;
                }
                if($solicitud->pivot->estado == 3 and $alumno->carrera_id == Auth::user()->carrera_id){
                    $aux_Rechazada++;
                }
                if($solicitud->pivot->estado == 4 and $alumno->carrera_id == Auth::user()->carrera_id){
                    $aux_Negada++;
                }
            }
        }

        return view('solicitud.resolver')->with('alumnos', $alumnos)->with('aux_Pendiente', $aux_Pendiente)->with('aux_Aceptada', $aux_Aceptada)
                                        ->with('aux_Observacion', $aux_Observacion)->with('aux_Rechazada', $aux_Rechazada)
                                        ->with('aux_Negada', $aux_Negada);
>>>>>>> origin/diegoVera
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
        $array = [1,2,3,4,5,6];
        $user = User::where('id', '=', $request['alumno'])->first();
        $array = [1,2,3,4,5,6];

        if($request['value'] == 1){
            $user->solicitudes()->wherePivot('id', $request['solicitud'])->updateExistingPivot($array, [
                'estado' => 1
            ]);
            $user->save();
            return back()->with('success','Solicitud Aceptada Exitosamente!');
        }
        if($request['value'] == 2){
            $user->solicitudes()->wherePivot('id', $request['solicitud'])->updateExistingPivot($array, [
                'estado' => 2,
            ]);
            $user->save();
            return back()->with('success','Solicitud Aceptada Exitosamente!');
        }
        if($request['value'] == 3){
            $user->solicitudes()->wherePivot('id', $request['solicitud'])->updateExistingPivot($array, [
                'estado' => 3,
            ]);
            $user->save();
            return back()->with('error','Solicitud Rechazada Exitosamente!');
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
