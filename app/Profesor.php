<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = "table_profesores";
    protected $fillable = ['DNI', 'Nombre', 'Apellido', 'Fecha_nac', 'Telefono', 'Direccion', 'Nacionalidad'];
}
