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
        $file = $request->file('file');
        
        Excel::import(new UserImport, $file);

        return back() ->withStatus('Archivo de excel importado de forma satisfactoria.');
    }
}
