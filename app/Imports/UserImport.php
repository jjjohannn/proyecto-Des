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
use Illuminate\Validation\Rules\Exists;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;


class UserImport implements 

    ToModel,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure

{

    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private $arrayImported = array();
    
    public function model(array $row)
    {
        echo ".";
        $importedRow = array('nombre' => $row['nombre'],'rut' => $row['rut'],'correo'=> $row['correo']);
        array_push($this->arrayImported,$importedRow);
        return new User([
            'carrera_id' => Carrera::where('codigo', $row['carrera'])->first()->id,
            'rut' => $row['rut'],
            'name' => $row['nombre'],
            'email' => $row['correo'],
            'password' => Hash::make(substr(Rut::parse($row['rut'])->number(), 0, 6)),
            'status'=> 1,
            'rol' => 2,
        ]);
    }
    public function rules(): array
    {
        return
        [
            
            '*.rut' => ['required', 'min:8', 'unique:users', new FormatoRut(), new ValidarRut()],
            '*.carrera' =>['required','exists:carreras,codigo','starts_With:1,2,3,4,5,6,7,8,9','integer'],
            '*.nombre' =>['required'],
            '*.correo' => ['required'],
        ];
    }
    public function getImported()
    {
        return $this->arrayImported;
    }
}
