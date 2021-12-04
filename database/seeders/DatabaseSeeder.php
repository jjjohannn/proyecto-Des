<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Administrador',
            'email' => 'admin@ucn.cl',
            'rut' => '191006364',
            'status' => 1,
            'rol' => 0,
            'password' => bcrypt("191006"),
        ]);

        \App\Models\User::create([
            'name' => 'Profesor',
            'email' => 'profesor@ucn.cl',
            'rut' => '17977139K',
            'status' => 1,
            'rol' => 1,
            'password' => bcrypt("179771"),
        ]);

        \App\Models\User::create([
            'name' => 'Alumno',
            'email' => 'alumno@.ucn.cl',
            'rut' => '113303832',
            'status' => 1,
            'rol' => 2,
            'password' => bcrypt("113303"),
        ]);

        \App\Models\Carrera::create([
            'codigo' => 1212,
            'nombre' => 'Carrera 1',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 2323,
            'nombre' => 'Carrera 2',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8039,
            'nombre' => 'Arquitectura',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8043,
            'nombre' => 'Derecho',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8050,
            'nombre' => 'Geología',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8055,
            'nombre' => 'Ingeniería Civil Ambiental',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8074,
            'nombre' => 'Ingeniería Civil de Minas',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8603,
            'nombre' => 'Ingeniería Civil en Computación e Informática',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8092,
            'nombre' => 'Ingeniería Civil Industrial',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8132,
            'nombre' => 'Ingeniería Civil Metalúrgica',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8141,
            'nombre' => 'Ingeniería Civil Plan Común',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8150,
            'nombre' => 'Ingeniería Civil Química',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8182,
            'nombre' => 'Ingeniería Comercial',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8184,
            'nombre' => 'Ingeniería en Computación e Informática',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8189,
            'nombre' => 'Ingeniería en Información y Control de Gestión',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8221,
            'nombre' => 'Ingeniería en Metalurgia',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8222,
            'nombre' => 'Ingeniería en Tecnologías de Información',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8277,
            'nombre' => 'Kinesiología',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8305,
            'nombre' => 'Licenciatura en Física con mención en Astronomía',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8349,
            'nombre' => 'Licenciatura en Matemática',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8421,
            'nombre' => 'Medicina',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8440,
            'nombre' => 'Nutrición y Dietética',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8474,
            'nombre' => 'Pedagogía en Educación Básica con Especialización',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8481,
            'nombre' => 'Pedagogía en Inglés',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8486,
            'nombre' => 'Pedagogía en Matemática en Educación Media',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8570,
            'nombre' => 'Periodismo',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8594,
            'nombre' => 'Psicología',
        ]);

        \App\Models\Carrera::create([
            'codigo' => 8659,
            'nombre' => 'Química y Farmacia',
        ]);

        \App\Models\Solicitud::create([
            'tipo' => 'Sobrecupo'
        ]);
        \App\Models\Solicitud::create([
            'tipo' => 'Cambio Paralelo'
        ]);
        \App\Models\Solicitud::create([
            'tipo' => 'Eliminación Asignatura'
        ]);
        \App\Models\Solicitud::create([
            'tipo' => 'Inscripción Asignatura'
        ]);
        \App\Models\Solicitud::create([
            'tipo' => 'Ayudantía'
        ]);
        \App\Models\Solicitud::create([
            'tipo' => 'Facilidades'
        ]);
    }
}
