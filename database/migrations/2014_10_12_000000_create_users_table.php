<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('rut')->unique();
            $table->tinyInteger('status');
            $table->tinyInteger('rol');
            $table->rememberToken();
            $table->timestamps();

            /** Esta es la conexion de la clave foranea entre las carreras y el usuario
             * se relaciona el id de la carrera con el usuario
             */
            $table->unsignedBigInteger("carrera_id")->nullable();
            $table->foreign("carrera_id")->references("id")->on("carreras");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
