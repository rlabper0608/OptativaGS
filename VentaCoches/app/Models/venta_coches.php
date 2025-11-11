<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class venta_coches extends Model {
    protected $table = 'venta_coches';

    protected $fillable = ['marca', 'modelo', 'year', 'precio'];
}
