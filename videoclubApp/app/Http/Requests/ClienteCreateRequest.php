<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteCreateRequest extends FormRequest {
    function attributes(): array {
        return [

            'DNI'           => 'DNI del cliente',
            'nombre'        => 'nombre del cliente',
            'apellidos'     => 'apellidos del cliente',
            'telefono'      => 'teléfono de contacto',
            'email'         => 'email de contacto',
            'foto'          => 'fotografía del cliente',
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
            // Reglas de DNI
            'DNI.required' => $required,
            'DNI.string' => $string,
            'DNI.min' => $min,
            'DNI.max' => $max,
            'DNI.unique' => 'El DNI debe ser único.',

            // Reglas de nombre
            'nombre.required' => $required,
            'nombre.string' => $string,
            'nombre.min' => $min,
            'nombre.max' => $max,

            // Reglas de apellidos
            'apellidos.required' => $required,
            'apellidos.string' => $string,
            'apellidos.min' => $min,
            'apellidos.max' => $max,

            // Reglas de telefono
            'telefono.required' => $required,
            'telefono.string' => $string,
            'telefono.min' => $min,
            'telefono.max' => $max,

            // Reglas de email
            'email.required' => $required,
            'email.string' => $string,
            'email.email' => "El email tiene que ser tipo email.",
            'email.min' => $min,
            'email.max' => $max,

            // Reglas de foto
            'foto.image' => "El tipo de foto tiene que ser una JPG, JPEG, PNG.",
            'foto.unique' => "La foto debe ser única.",
        ];
    }

    public function rules(): array
    {
        return [
            'DNI'           => 'required|string|min:9|max:9|unique:cliente,DNI',
            'nombre'        => 'required|string|min:3|max:60',
            'apellidos'     => 'required|string|min:3|max:60',
            'telefono'      => 'required|string|min:9|max:9',
            'email'         => 'required|string|min:3|max:70|email|unique:cliente,email',
            'foto'          => 'nullable|image',
        ];
    }
}