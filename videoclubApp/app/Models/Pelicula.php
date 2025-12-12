<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelicula extends Model {
    
    protected $table = 'pelicula';

    protected $fillable = ['titulo', 'director', 'fecha_estreno','genero', 'actores', 'year', 'duracion', 'clasificacion', 'portada'];

    function getPath(): string {
        $path = url('assets/img/sin_portada_peli.jpg');
        
        if($this->portada != null && file_exists(storage_path('app/public'). '/' . $this->portada)) {
            $path = url('storage/' . $this->portada);
        }
        return $path;
    }

    function copia(): HasMany {
        return $this->hasMany('App\Models\Copia', 'idpelicula');
    }

    function valoraciones(): HasMany {
        return $this->hasMany('App\Models\Valoracion', 'idpelicula');
    }
}
