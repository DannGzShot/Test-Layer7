<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class PermissionsRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    

    public function rules()
    {
        return [
            'name' => 'required|max:55',
        ];
    }
}
