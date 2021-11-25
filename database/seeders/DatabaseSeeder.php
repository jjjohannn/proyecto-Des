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

        \App\Models\Carrera::create([
            'codigo' => 1234,
            'nombre' => 'Carrera 1',
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
