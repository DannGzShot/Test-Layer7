<?php

namespace App\Http\Requests\Users;

use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'id_role' => 'required',
        ];
    
        // Agregar reglas solo en creación
        if (empty($this->input('id'))) {
            $rules['email'] .= '|unique:users';
            $rules['password'] = 'required|confirmed';
            $rules['password_confirmation'] = 'required';
        }
    
        return $rules;
    }
    
}
