<?php

namespace App\Http\Controllers;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UsersImportController extends Controller
{
    public function show()
    {
        return view('usuario.import');
    }

    public function store(Request $request)
    {
        if($request->file('file') == NULL){
            return back()->with('warning', 'Archivos no detectados.');
        }
        $file = $request->file('file')->store('import');
        $import = new UserImport;
        $import->import($file);

        if($import->failures()->isNotEmpty()) return back()->withFailures($import->failures())->withStatus('El archivo contuvo algunos errores, seran descartados y el resto sera importado de todas formas.');

        return back() ->withStatus('Archivo de excel importado de forma satisfactoria.');
    }

}
