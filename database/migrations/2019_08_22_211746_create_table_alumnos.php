<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAlumnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_alumnos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('DNI');
            $table->string('Nombre');
            $table->string('Apellido');
            $table->date('Fecha_nac');
            $table->string('Telefono');
            $table->string('Direccion');
            $table->string('Nacionalidad');
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
        Schema::dropIfExists('table_alumnos');
    }
}
