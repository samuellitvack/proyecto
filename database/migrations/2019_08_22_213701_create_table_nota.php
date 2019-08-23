<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_nota', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nota_1');
            $table->integer('nota_2');
            $table->integer('nota_3');

            $table->bigInteger('id_alumno')->unsigned()->nullable();
            $table->foreign('id_alumno')->references('id')->on('table_alumnos');

            $table->bigInteger('id_curso')->unsigned()->nullable();
            $table->foreign('id_curso')->references('id')->on('table_cursos');

            $table->bigInteger('id_mat')->unsigned()->nullable();
            $table->foreign('id_mat')->references('id')->on('table_materias');
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
        Schema::dropIfExists('table_nota');
    }
}
