<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
	protected $table = "table_configuracion";
    protected $fillable = ['1c_fecini','1c_fecfin','2c_fecini','2c_fecfin','3c_fecini','3c_fecfin'];
}
