<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alquiler extends Model{
    protected $table = 'alquiler';

    protected $fillable = ['idcopia', 'idcliente', 'fecha_dev', 'fecha_sal', 'precio'];

     public function copia(): BelongsTo {
        return $this->belongsTo(Copia::class, 'idcopia');
    }

    public function cliente(): BelongsTo {
        return $this->belongsTo(Cliente::class, 'idcliente');
    }
}
