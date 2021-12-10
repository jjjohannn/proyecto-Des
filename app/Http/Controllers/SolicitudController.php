<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\User;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Exists;

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
                    'telefono' => ['regex:/[0-9]*/','required'],
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
                    'telefono' => ['regex:/[0-9]*/','required'],
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
                    'telefono' => ['regex:/[0-9]*/','required'],
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
                    'telefono' => ['regex:/[0-9]*/','required'],
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
                    'telefono' => ['regex:/[0-9]*/','required'],
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
                    'calificacion_aprob' => $request->calificacion,
                    'cant_ayudantias' => $request->cantidad
                ]);
                return redirect('/solicitud');
            break;

            case '6':
            $request->validate([
                'telefono' => ['regex:/[0-9]*/','required'],
                'nombre' => ['required'],
                'detalle' => ['required'],
                'facilidad' => ['required'],
                'profesor' => ['required'],
                'adjunto.*' => ['mimes:pdf,jpg,jpeg,doc,docx,png'],
            ]);

            $findUser = User::find($request->user);
            $aux = 0;

            foreach ($request->adjunto as $file) {

                $name = $findUser->rut.'-'.$file->getClientOriginalName();;
                $file->move(public_path('\storage\docs'), $name);
                $datos[] = $name;
                $aux++;
            }


            $findUser->solicitudes()->attach($request->tipo, [
                'telefono' => $request->telefono,
                'nombre_asignatura' => $request->nombre,
                'detalles' => $request->detalle,
                'tipo_facilidad' => $request->facilidad,
                'nombre_profesor' => $request->profesor,
                'archivos' => json_encode($datos),
            ]);
            return redirect('/solicitud');
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
    public function show(Solicitud $solicitud)
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
        $id_user = Auth::user()->id;
        $user = User::where('id','=', $id_user)->first();
        $user2 = User::where('id', $id_user)->firstOrFail()->getSolicitudId($id)->first();
        $archivos_viejos[] = $user2->getOriginal()['pivot_archivos'];
        $piezas = explode(",", $archivos_viejos[0]);
        $aux = 0;
        $extensiones = ['pdf','jpg','jpeg','doc','docx','png'];
        $eliminar = [" ","[","]","\""];
        //dd($piezas);
        $array = [1,2,3,4,5,6];

       if($request->isNotFilled('telefono','nrc','nombre','detalle','calificacion','cantidad','facilidad','profesor') && $request->adjunto == null ){
            return back()->with('error','No pueden estar todos los campos vacíos, llene al menos uno');
        }
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
        if($request->adjunto != null){

            foreach ($request->adjunto as $file) {
                if(!in_array($file->getClientOriginalExtension(), $extensiones)){
                    return back()->with('error','Los archivos deben estar en uno de estos formatos: pdf, jpg, jpeg, doc, docx, png');
                }
                $name = $user->rut.'-'.$file->getClientOriginalName();
                $file->move(public_path('\storage\docs'), $name);
                $datos[] = $name;
                $aux++;
            }
            foreach ($piezas as $archivo) {
                $datos[] = str_replace($eliminar,"",$archivo);
            }

            //dd($datos);
            if(count($datos) > 3){
                return back()->with('error','No se pueden adjuntar más de tres archivos');
            }

            $user->solicitudes()->wherePivot('id', $id)->updateExistingPivot(6, [
                'archivos' => $datos
            ]);
        }
       // dd($user->solicitudes()->wherePivot('id', $id));
        $user->save();
        return redirect('/solicitud')->with('success','Editado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $file)
    {

    }

    /**
     * Anula la solicitud deseada.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Elimina un archivo.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function eliminacion(Request $request){
        //dd($request->nombre);
        $id_sol = $request->id;
        $id_user = Auth::user()->id;
        $user = User::where('id','=', $id_user)->first();
        $user2 = User::where('id', $id_user)->firstOrFail()->getSolicitudId($id_sol)->first();
        $archivos_viejos[] = $user2->getOriginal()['pivot_archivos'];
        $piezas = explode(",", $archivos_viejos[0]);
        $eliminar = [" ","[","]","\""];
        $acortador = str_replace($eliminar,"",$request->nombre);

        foreach ($piezas as $archivo) {
            $archivos[] = str_replace($eliminar,"",$archivo);
        }

        foreach ($archivos as $noEliminado) {
            if($noEliminado != $acortador)
            $datos[] = $noEliminado;
        }

        if(count($archivos)<=1){
            return back()->with('error', 'Se necesita tener al menos un archivo, suba otro y luego elimine el que quiere');
        }


        $user->solicitudes()->wherePivot('id', $id_sol)->updateExistingPivot(6, [
            'archivos' => $datos
        ]);

        $user->save();
        return back()->with('success', 'Se ha eliminado el archivo');

    }

}
