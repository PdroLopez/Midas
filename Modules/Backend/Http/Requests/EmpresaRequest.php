<?php

namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'razon_social' => 'required|max:70',
            'rut' => 'required|max:12',
            'bk_estados_id' =>'required',
            'marcas_id' =>'required',



        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es Requerido',
            'nombre.max' => 'El nombre excede el limite de caracteres',
            'nombre.min' => 'El nombre no cumple el limite de caracteres',
            //
            'razon_social.required' => 'El razon_social es Requerido',
            'razon_social.max' => 'El razon_social excede el limite de caracteres',
            'razon_social.min' => 'El razon_social no cumple el limite de caracteres',
            //
            'rut.required' => 'El razon_social es Requerido',
            'rut.max' => 'El razon_social excede el limite de caracteres',
            'rut.min' => 'El razon_social no cumple el limite de caracteres',
            //
            'bk_estados_id.required' => 'El razon_social es Requerido',
            'bk_estados_id.max' => 'El razon_social excede el limite de caracteres',
            'bk_estados_id.min' => 'El razon_social no cumple el limite de caracteres',
            //
            'marcas_id.required' => 'El razon_social es Requerido',
            'marcas_id.max' => 'El razon_social excede el limite de caracteres',
            'marcas_id.min' => 'El razon_social no cumple el limite de caracteres',
        ];
    }
}
