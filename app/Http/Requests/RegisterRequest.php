<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name'=>['required','string'],
            'email'=>['required','email','unique:users'],
            'phone'=>['required','unique:users','regex:/^01[0-2,5,9]{1}[0-9]{8}$/'],
            'password'=>['required','min:8','confirmed'],
            'device_name'=>['required']
          
        ];
    }
}
