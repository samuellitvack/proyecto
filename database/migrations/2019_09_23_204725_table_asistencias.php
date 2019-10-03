<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableAsistencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_asistencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_alumno')->unsigned()->nullable();
            $table->foreign('id_alumno')->references('id')->on('table_alumnos');

            $table->bigInteger('id_curso')->unsigned()->nullable();
            $table->foreign('id_curso')->references('id')->on('table_cursos');

            $table->boolean('Presente');
            $table->boolean('Justificada');

            $table->date('Fecha');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_asistencias');
    }
}
