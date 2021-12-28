<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ResolverSolicitudMailable;
use Illuminate\Support\Facades\Mail;

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
        $usuario = User::where('id', '=', $request['alumno'])->first();
        $solicitud = User::where('id', $request['alumno'])->firstOrFail()->getSolicitudId($request['solicitud'])->first();
        switch ($request->input('action')){
            case 'aceptar':
                $resultado = "Aceptada";
                $usuario->solicitudes()->wherePivot('id', $request['solicitud'])->updateExistingPivot($array, [
                    'estado' => 1
                ]);
                $usuario->save();
                $comentario = "Sin comentarios";
                Mail::to($usuario)->send(new ResolverSolicitudMailable($solicitud, $resultado, $comentario));
                return redirect('/resolver')->with('success','Solicitud Aceptada Exitosamente!');
                break;

            case 'observacion':
                $resultado = "Aceptada con observación";
                $request->validate(
                    ['detalles' => ['required']],
                    $messages = [
                        'detalles.required' => 'Los detalles de observación son requeridos.'
                    ]
            );
                $usuario->solicitudes()->wherePivot('id', $request['solicitud'])->updateExistingPivot($array, [
                    'estado' => 2,
                    'detalles' => $request['detalles']
                ]);
                $usuario->save();
                $comentario = $request['detalles'];
                Mail::to($usuario)->send(new ResolverSolicitudMailable($solicitud, $resultado, $comentario));
                return redirect('/resolver')->with('success','Solicitud Aceptada Exitosamente!');
                break;

            case 'rechazar':
                $resultado = "Rechazada";
                $request->validate(
                    ['detalles2' => ['required']],
                    $messages = [
                        'detalles2.required' => 'Los detalles de rechazo son requeridos.'
                    ]
            );
                $usuario->solicitudes()->wherePivot('id', $request['solicitud'])->updateExistingPivot($array, [
                    'estado' => 3,
                    'detalles' => $request['detalles2']
                ]);
                $usuario->save();
                $comentario = $request['detalles2'];
                Mail::to($usuario)->send(new ResolverSolicitudMailable($solicitud, $resultado, $comentario));
                return redirect('/resolver')->with('success','Solicitud Rechazada Exitosamente!');
                break;
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
