<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Rules\FormatoRut;
use App\Rules\ValidarRut;
use App\Models\Carrera;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //$carrera = Carrera::where('codigo', $row[0])->pluck('id');
        //$password = substr(Rut::parse($row[1])->number(), 0, 6);
        return new User([
            //
            'rut' => $row[1],
            'name' => $row[2],
            'email' => $row[3],
            'password' => Hash::make(substr(Rut::parse($row[1])->number(), 0, 6)),
            'status'=> 1,
            'rol' => 2,
            'carrera_id' => Carrera::where('codigo', $row[0])->first()->id,
        ]);
    }
}
