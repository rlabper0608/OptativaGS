<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Copia extends Model {

    protected $table = 'copia';

    protected $fillable = ['idpelicula', 'codigo_barras', 'estado', 'formato'];

    public function pelicula(): BelongsTo {
        return $this->belongsTo(Pelicula::class, 'idpelicula');
    }

    public function cliente(): BelongsTo {
        return $this->belongsTo(Cliente::class, 'idcliente');
    }
}
