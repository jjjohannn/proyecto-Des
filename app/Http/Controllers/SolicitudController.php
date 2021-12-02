<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\User;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Rules\Telefono;


class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudesAlumno = Auth::user()->solicitudes;
        return view('solicitud.index')->with('solicitudes', $solicitudesAlumno);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('solicitud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        switch ($request->tipo) {
            case '1':
                $request->validate([
                    'telefono' => ['integer','required', new Telefono()],
                    'nrc' => ['required'],
                    'nombre' => ['required'],
                    'detalle' => ['required']
                ]);

                $findUser = User::find($request->user);

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'NRC' => $request->nrc,
                    'nombre_asignatura' => $request->nombre,
                    'detalles' => $request->detalle
                ]);
                return redirect('/solicitud');
            break;

            case '2':
                $request->validate([
                    'telefono' => ['integer','required', new Telefono()],
                    'nrc' => ['required'],
                    'nombre' => ['required'],
                    'detalle' => ['required']
                ]);

                $findUser = User::find($request->user);

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'NRC' => $request->nrc,
                    'nombre_asignatura' => $request->nombre,
                    'detalles' => $request->detalle
                ]);
                return redirect('/solicitud');
            break;

            case '3':
                $request->validate([
                    'telefono' => ['integer','required', new Telefono()],
                    'nrc' => ['required'],
                    'nombre' => ['required'],
                    'detalle' => ['required']
                ]);

                $findUser = User::find($request->user);

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'NRC' => $request->nrc,
                    'nombre_asignatura' => $request->nombre,
                    'detalles' => $request->detalle
                ]);
                return redirect('/solicitud');
            break;

            case '4':
                $request->validate([
                    'telefono' => ['integer','required', new Telefono()],
                    'nrc' => ['required'],
                    'nombre' => ['required'],
                    'detalle' => ['required']
                ]);

                $findUser = User::find($request->user);

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'NRC' => $request->nrc,
                    'nombre_asignatura' => $request->nombre,
                    'detalles' => $request->detalle
                ]);
                return redirect('/solicitud');
            break;

            case '5':
                $request->validate([
                    'telefono' => ['integer','required', new Telefono()],
                    'nombre' => ['required'],
                    'calificacion' => ['required'],
                    'cantidad' => ['required', 'integer'],
                    'detalle' => ['required']
                ]);

                $findUser = User::find($request->user);

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'nombre_asignatura' => $request->nombre,
                    'detalles' => $request->detalle,
<<<<<<< HEAD
                    'calificacion_aprob' => $request->calificacion,
                    'cant_ayudantias' => $request->cantidad
=======
                    'calificacion' => $request->calificacion_aprob,
                    'cant_ayudantias' => $request->cant_ayudantias
>>>>>>> origin/diegoVera
                ]);
                return redirect('/solicitud');
            break;

            case '6':
                $validator = Validator::make($request->all(), [
                    'telefono' => ['integer','required', new Telefono()],
                    'nombre' => ['required'],
                    'detalle' => ['required'],
                    'facilidad' => ['required'],
                    'profesor' => ['required'],
                    'adjunto.*' => ['mimes:pdf|max:3'],
                ]);

                if($validator->fails()){
                    return back()->with('warning','Solo se permiten archivos de tipo pdf.');
                }

                $findUser = User::find($request->user);

                $aux = 0;

                if($request->adjunto){
                    foreach ($request->adjunto as $file) {
                        $name = $aux.time().'-'.$findUser->name.'.pdf';
                        $file->move(public_path('\storage\docs'), $name);
                        $datos[] = $name;
                        $aux++;
                    }

                    if($aux > 3){
                        return back()->with('warning', 'Solo se pueden ingresar hasta 3 archivos.');
                    }
                }else{
                    $datos = NULL;
                }

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'nombre_asignatura' => $request->nombre,
                    'detalles' => $request->detalle,
                    'tipo_facilidad' => $request->facilidad,
                    'nombre_profesor' => $request->profesor,
                    'archivos' => json_encode($datos),
                ]);
                return redirect('/solicitud')->with('Success, Se ha generado la solicitud exitosamente!.');
            break;

            default:
                # code...
            break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(String $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(String $id)
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->firstOrFail()->getSolicitudId($id)->first();
        //dd($user->getOriginal()['tipo']);
        return view('solicitud/edit')->with('solicitud', $user);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, String $id)
    {
        //dd($request);
        $id_user = Auth::user()->id;
        $user = User::where('id','=', $id_user)->first();
        $array = [1,2,3,4,5,6];
        if($request->filled('telefono')){
            $request->validate(['telefono' => ['regex:/[0-9]*/','required']]);
            $user->solicitudes()->wherePivot('id', $id)->updateExistingPivot($array, [
                'telefono' => $request['telefono']
            ]);
        }
        if ($request->filled('nrc')) {
            $request->validate(['nrc' => ['required']]);
            $user->solicitudes()->wherePivot('id', $id)->updateExistingPivot($array, [
                 'NRC' => $request['nrc']
            ]);
        }
        if ($request->filled('nombre')) {
            $request->validate(['nombre' => ['required']]);
            $user->solicitudes()->wherePivot('id', $id)->updateExistingPivot($array, [
                'nombre_asignatura' => $request['nombre']
            ]);
        }
        if ($request->filled('detalle')) {
            $request->validate(['detalle' => ['required']]);
            $user->solicitudes()->wherePivot('id', $id)->updateExistingPivot($array, [
                'detalles' => $request['detalle']
            ]);
        }
        if($request->filled('calificacion')){
            $request->validate(['calificacion' => ['required']]);
            $user->solicitudes()->wherePivot('id', $id)->updateExistingPivot($array, [
                'calificacion_aprob' => $request['calificacion']
            ]);
        }
        if($request->filled('cantidad')){
            $request->validate(['cantidad' => ['required']]);
            $user->solicitudes()->wherePivot('id', $id)->updateExistingPivot($array, [
                'cant_ayudantias' => $request['cantidad']
            ]);
        }
        if($request->filled('facilidad')){
            $request->validate(['facilidad' => ['required']]);
            $user->solicitudes()->wherePivot('id', $id)->updateExistingPivot($array, [
                'tipo_facilidad' => $request['facilidad']
            ]);
        }
        if($request->filled('profesor')){
            $request->validate(['profesor' => ['required']]);
            $user->solicitudes()->wherePivot('id', $id)->updateExistingPivot($array, [
                'nombre_profesor' => $request['profesor']
            ]);
        }
        if($request->filled('adjunto[]')){
            $request->validate(['adjunto[]' => ['required']]);
            $user->solicitudes()->wherePivot('id', $id)->updateExistingPivot($array, [
                'archivos' => $request['adjunto[]']
            ]);
        }

        $user->save();
        return redirect('/solicitud')->with('success','editado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $solicitud)
    {
        //
    }

    public function anulacion(Request $request){
        //dd($request->id);
        $id_user = Auth::user()->id;
        $array = [1,2,3,4,5,6];
        $user = User::where('id','=', $id_user)->first();
        //dd($array);
        $user->solicitudes()->wherePivot('id', $request->id)->updateExistingPivot($array, [
            'estado' => 4
        ]);
        $user->save();
        return redirect('/solicitud');
    }

}
