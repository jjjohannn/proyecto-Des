<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Rules\CodigoCarrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    /**
     * En este metodo index se manda la lista de carreras a la vista register.blade.php para poder desplegar la lista de carreras
     * $carreras almacena todas las carreras creadas en el sistema
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $carreras = Carrera::all();
        if($carreras == null){
            return view('usuario.index');
        }else{
            return view('carreras.index')->with('carreras', $carreras);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('carreras.agregarCarrera');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // falta validar
        $request->validate([
            'nombre' => ['required','min:1'],
            'codigo'=>['required','digits:4','unique:carreras','starts_With:1,2,3,4,5,6,7,8,9','integer'],
        ]);

        Carrera::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre
        ]);

        return redirect('/carreras')->with('success','Carrera creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function show(Carrera $carrera)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function edit(Carrera $carrera)
    {
        //
        return view('carreras.editarCarrera')->with('carrera',$carrera);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $carrera=carrera::find($id);
        $data=$request->except('codigo');
        $carrera->update($data);
        $carrera->save();
        return redirect('/carreras');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carrera $carrera)
    {
        //
    }
}
