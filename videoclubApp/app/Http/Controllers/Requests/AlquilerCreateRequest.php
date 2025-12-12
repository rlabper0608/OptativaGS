<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 
use Carbon\Carbon; // Para usar en la validación de fechas

class AlquilerCreateRequest extends FormRequest {

    /**
     * Define los nombres amigables de los atributos para usarlos en los mensajes de error.
     */
    function attributes(): array {
        return [
            'idcopia'    => 'copia de la película',
            'idcliente'  => 'cliente',
            'fecha_sal'  => 'fecha de salida (alquiler)',
            'fecha_dev'  => 'fecha de devolución',
            'precio'     => 'precio del alquiler',
        ];
    }

    function authorize(): bool {
        return true;
    }

    function messages(): array {
        // Variables para mensajes repetitivos
        $required = 'Es obligatorio introducir :attribute.';
        $min = 'La longitud mínima del campo :attribute es :min.';
        $max = 'La longitud máxima del campo :attribute es :max.';
        $string = "El campo debe ser un string.";

        return [
            // Reglas de idcopia
            'idcopia.required'   => $required,
            'idcopia.exists'     => 'La copia de la película seleccionada no es válida.',
            
            // Reglas de idcliente
            'idcliente.required' => $required,
            'idcliente.exists'   => 'El cliente seleccionado no existe.',

            // Reglas de fecha_sal
            'fecha_sal.required' => $required,
            'fecha_sal.date'     => 'La fecha de salida debe ser una fecha válida.',
            
            // Reglas de fecha_dev
            'fecha_dev.date'     => 'La fecha de devolución debe ser una fecha válida.',
            
            // Reglas de precio
            'precio.required'  => $required,
            'precio.integer'   => 'El precio debe ser un valor numérico.',
            'precio.min'       => $min,
            'precio.max'       => $max,
        ];
    }

    public function rules(): array
    {
        return [
            'idcopia'    => 'required|exists:copia,id',
            'idcliente'  => 'required|exists:cliente,id',
            'fecha_sal'  => 'required|date',
            'fecha_dev'  => 'nullable|date',
            'precio'     => 'required|integer|min:1|max:999',
        ];
    }
}