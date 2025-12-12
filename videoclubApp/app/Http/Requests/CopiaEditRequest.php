<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CopiaEditRequest extends CopiaCreateRequest {
    public function rules(): array {
        $array = parent::rules();
        $array ["codigo_barras"] = 'required|string|min:10|max:10|unique:copia,codigo_barras,'.$this->copia->id;

        return $array;
    }
}