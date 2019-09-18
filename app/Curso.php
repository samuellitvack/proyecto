<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = "table_cursos";
    protected $fillable = ['Nombre', 'Division', 'Año'];
}
