<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model{
    
    protected $table = 'cliente';

    protected $fillable = ['DNI', 'nombre', 'apellidos', 'telefono', 'email', 'foto'];

    function getPath():string {
        $path = url('assets/img/sin_foto_perfil.jpg');
        
        if($this->foto != null && file_exists(storage_path('app/public'). '/' . $this->foto)) {
            $path = url('storage/' . $this->foto);
        }
        return $path;
    }

    function alquiler(): HasMany {
        return $this->hasMany('App\Models\Alquiler', 'idcliente');
    }
}
