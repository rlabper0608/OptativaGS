<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteEditRequest extends ClienteCreateRequest {


    public function rules(): array{
       
        $array = parent::rules();
        $array ['DNI'] = 'required|string|min:9|max:9|unique:cliente,DNI,'.$this->cliente->id;
        $array['email'] = 'required|string|min:3|max:70|email|unique:cliente,email,'.$this->cliente->id;

        return $array;
    }
}