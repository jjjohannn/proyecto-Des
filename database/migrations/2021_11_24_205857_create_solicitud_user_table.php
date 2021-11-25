<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_user', function (Blueprint $table) {
            $table->id();
            $table->string('telefono');
            $table->tinyInteger('estado')->default(0); //0: Pendiente, 1:Aceptada, 2:Aceptada con obs, 3:Rechazada

            //columnas para sobrecupo, cambio paralelo, eliminación e inscripción asignatura.
            $table->string('NRC')->nullable();
            $table->string('nombre_asignatura')->nullable();
            $table->string('detalles')->nullable();

            //columnas para solicitud ayudantía
            $table->string('calificacion_aprob')->nullable();
            $table->integer('cant_ayudantias')->nullable();

            //columnas facilidades academicas
            $table->enum('tipo_facilidad',['Licencia', 'Inasistencia Fuerza Mayor', 'Representacion', 'Inasistencia Motivo Personal'])->nullable();
            $table->string('nombre_profesor')->nullable();
            $table->json('archivos')->nullable();

            //relaciones
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users");

            $table->unsignedBigInteger("solicitud_id")->nullable();
            $table->foreign("solicitud_id")->references("id")->on("solicituds");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_user');
    }
}
