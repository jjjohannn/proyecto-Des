<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BuscarEstudianteController extends Controller
{
    public function devolverEstudiante(Request $request){

        //select * from user where rut = $rut
        $findUser = User::where('rut', $request->rut)->first();

        if (isset($findUser)) {
            if ($findUser->rol == "Alumno") {
                return redirect(route('mostrarEstudiante',['id' => $findUser->id]));
            }else {
                return redirect('buscar-estudiante')->with('error', 'El rut ingresado no es Alumno.');
            }
        }else {
            return redirect('buscar-estudiante')->with('error', 'Alumno no encontrado.');
        }
    }


    public function mostrarEstudiante(String $id){
        $user = User::where('id', $id)->with('carrera')->with('solicitudes')->first();

        return view('alumno.index')->with('user', $user);
    }

    public function verDatosSolicitud (String $id, String $alumno_id){

        $getUser = User::where('id', $id)->firstOrFail()->getSolicitudId($alumno_id)->first();
        return view('datosSolicitud.index')->with('solicitud',$getUser);
    }

    public function datos (String $id, String $alumno_id){

        $getUser = User::where('id', $id)->firstOrFail()->getSolicitudId($alumno_id)->first();
        $alumno = User::where('id', $id)->first();
        return view('solicitud/informacion')->with('solicitud',$getUser)->with('alumno', $alumno);
    }
}
