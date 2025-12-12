<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeliculaCreateRequest extends FormRequest {

    function attributes(): array {
        return [
            'titulo'            => 'título de la pelicula',
            'director'          => 'director de la pelicula',
            'genero'            => 'género de la pelicula',
            'fecha_estreno'     => 'fecha de estreno de la pelicula',
            'duracion'          => 'duración de la pelicula',
            'clasificacion'     => 'clasificación de la pelicula',
            'actores'           => 'actores de la pelicula',
            'portada'           => 'portada de la pelicula',
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
        $minNumber = 'El valor mínimo del campo :attribute es :min.';
        $maxNumber = 'El valor máximo del campo :attribute es :max.';
        $unique = 'El título de la película debe ser único. Ese nombre ya se ha usado.';
        $string = "El campo debe ser un string.";
        
        return [
            // Reglas de Título
            'titulo.required'   => $required,
            'titulo.min'        => $min,
            'titulo.max'        => $max,
            'titulo.string'     => $string,
            
            // Reglas de Director
            'director.required' => $required,
            'director.min'      => $min,
            'director.max'      => $max,
            'director.string'     => $string,
            
            // Reglas de Género
            'genero.required'   => $required,
            'genero.min'        => $min, 
            'genero.max'        => $max,
            'genero.string'     => $string, 

            // Reglas de Fecha de Estreno
            'fecha_estreno.required' => $required,
            'fecha_estreno.date' => 'La :attribute debe ser una fecha válida.',
            
            // Reglas de Duración
            'duracion.required' => $required,
            'duracion.integer'  => 'La :attribute debe ser un número entero (en minutos).',
            'duracion.min'      => $minNumber,
            'duracion.max'      => $maxNumber,
            
            // Reglas de Clasificación
            'clasificacion.required' => $required,
            'clasificacion.min'      => $min,
            'clasificacion.max'      => $max,
            'clasificacion.string'     => $string,
            
            // Reglas de Actores
            'actores.required'  => $required,
            'actores.min'       => $min,

            // Reglas de Portada
            'portada.image'     => 'El archivo tiene que ser una imagen.',
            'portada.unique'     => 'La :attribute debe ser de formato JPG, PNG o GIF.',
        ];
    }

    function rules(): array {
        return [
            'titulo'            => 'required|string|min:3|max:60',
            'director'          => 'required|string|min:3|max:60',
            'genero'            => 'required|string|min:3|max:60',
            'fecha_estreno'     => 'required|date',
            'duracion'          => 'required|integer|min:1|max:999',
            'clasificacion'     => 'required|string|min:3|max:60',
            'actores'           => 'required|string|min:20', 
            'portada'           => 'nullable|image|unique:pelicula,portada', 
        ];
    }
}