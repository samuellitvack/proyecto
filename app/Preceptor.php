<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preceptor extends Model
{
    protected $table = "table_preceptores";
    protected $fillable = ['DNI', 'Nombre', 'Apellido', 'Fecha_nac', 'Telefono', 'Direccion', 'Nacionalidad'];
}
