<?php

namespace App\Http\Controllers;
use App\Imports\UserImport;
use GuzzleHttp\Psr7\MimeType;
use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

use function Symfony\Component\VarDumper\Dumper\esc;

class UsersImportController extends Controller
{
    public function show()
    {
        return view('usuario.import');
    }

    public function store(Request $request)
    {
        
        $file = $request->file('file');

        if(empty($file)) 
        {
            return back()->withErrors("");
        }

        else if (!in_array($file->getMimeType(), array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-excel', 'text/csv', 'text/plain', 'text/tsv')))
        {
            return back()->withErrors('Porfavor solo archivos excel');
        }
    
        $import = new UserImport;
        $import->import($file);
        $importedUsers = $import->getImported();
        //dd($importedUsers);
        dd($import ->failures());
        if(empty($importedUsers))
        {
            if($import->failures()->isNotEmpty())
            {
                return back()->withFailures($import->failures())->withStatus('No se logro importar usuario alguno debido a que todas las filas del documento tienen errores');
            }
            else
            {
                return back()->withStatus('El archivo esta vacio');
            }
        }
        else
        {
            if($import->failures()->isNotEmpty())
            {
                return back()->withFailures($import->failures())->withStatus('El archivo contuvo algunos errores.')->with('importedUsers',$importedUsers);
            }
            else
            {
                return back() ->withStatus('Archivo de excel importado de forma satisfactoria y sin errores.')->with('importedUsers',$importedUsers);
            }
        }
    }

}
