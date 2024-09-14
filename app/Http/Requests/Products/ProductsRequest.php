<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:55',
            'description' => 'required|max:255',
            'quantity' => 'required|integer|min:1',
            'max_quantity' => 'required|integer|min:1|max:999',
            'min_quantity' => 'required|integer|min:0|max:999',
            'price' => 'required|numeric|min:0',
            'max_quantity' => 'gte:min_quantity',
            'min_quantity' => 'lte:max_quantity',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El campo nombre no debe superar los 55 caracteres.',
            'description.required' => 'El campo descripción es obligatorio.',
            'description.max' => 'El campo descripción no debe superar los 255 caracteres.',
            'quantity.required' => 'El campo cantidad es obligatorio.',
            'quantity.integer' => 'La cantidad debe ser un número entero.',
            'quantity.min' => 'La cantidad mínima es 1.',
            'max_quantity.required' => 'El campo cantidad máxima es obligatorio.',
            'max_quantity.integer' => 'La cantidad máxima debe ser un número entero.',
            'max_quantity.min' => 'La cantidad máxima mínima es 1.',
            'max_quantity.max' => 'La cantidad máxima no debe superar 999.',
            'min_quantity.required' => 'El campo cantidad mínima es obligatorio.',
            'min_quantity.integer' => 'La cantidad mínima debe ser un número entero.',
            'min_quantity.min' => 'La cantidad mínima mínima es 0.',
            'min_quantity.max' => 'La cantidad mínima no debe superar 999.',
            'price.required' => 'El campo precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio mínimo es 0.',
            'max_quantity.gte' => 'La cantidad máxima no debe ser menor que la cantidad mínima.',
            'min_quantity.lte' => 'La cantidad mínima no debe ser mayor que la cantidad máxima.',
        ];
    }
}
