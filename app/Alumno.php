<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = "table_alumnos";
    protected $fillable = ['DNI', 'Nombre', 'Apellido', 'Fecha_nac', 'Telefono', 'Direccion', 'Nacionalidad'];
}
