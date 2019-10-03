<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConfiguracion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_configuracion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('1c_fecini');
            $table->date('1c_fecfin');
            $table->date('2c_fecini');
            $table->date('2c_fecfin');
            $table->date('3c_fecini');
            $table->date('3c_fecfin');
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
        Schema::dropIfExists('table_configuracion');
    }
}
