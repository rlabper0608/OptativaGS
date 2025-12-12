<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CopiaCreateRequest extends FormRequest {

    function attributes(): array {
        return [
            'idpelicula'    => 'película asociada',
            'codigo_barras' => 'código de barras',
            'estado'        => 'estado de la copia',
            'formato'       => 'formato de la copia',
        ];
    }

    function authorize(): bool {
        return true;
    }

    function messages(): array {
        // Variables para mensajes repetitivos
        $required = 'Es obligatorio introducir :attribute.';
        $string = "El campo debe ser una cadena de texto.";
        $min = 'La longitud mínima del campo :attribute es :min.';
        $max = 'La longitud máxima del campo :attribute es :max.';

        return [
            // Reglas de idpelicula
            'idpelicula.required'       => $required,
            'idpelicula.exists'         => 'La :attribute seleccionada no existe.',

            // Reglas de codigo_barras
            'codigo_barras.required' => $required,
            'codigo_barras.string' => $string,
            'codigo_barras.min' => $min,
            'codigo_barras.max' => $max,
            'codigo_barras.unique' => 'Este :attribute ya está registrado.',

            // Reglas de estado
            'estado.required' => $required,
            'estado.in' => 'El estado seleccionado no existe',

            'formato.required' => $required,
            'formato.string' => $string,
            'formato.min' => $min,
            'formato.max' => $max,
        ];
    }

    public function rules(): array
    {
        return [
            'idpelicula'    => 'required|exists:pelicula,id',
            'codigo_barras' => 'required|string|min:10|max:10|unique:copia,codigo_barras',
            'estado'        => 'required|in:Disponible,Alquilado,Estropeado',
            'formato'       => 'required|in:DVD,Blu-Ray,CD',
        ];
    }
}