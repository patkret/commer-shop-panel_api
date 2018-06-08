<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|min:5',
            'confirm-password' => 'required|same:password|min:5'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Hasło jest wymagane',
            'confirm-password.required' => 'Potwierdź hasło',
            'password.min' => 'Hasło musi zawierać przynajmniej 5 znaków',
            'confirm-password.same' => 'Podane hasła nie są takie same'
        ];
    }
}
