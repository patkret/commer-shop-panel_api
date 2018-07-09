<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
            'title' => 'required',
            'content' => 'required',
            'shippingTime' => 'required'

        ];
    }
    public function messages(){
        return [
            'title.required' => 'Pole tytuł jest wymagane!',
            'content.required' => 'Pole treść jest wymagane!',
            'shippingTime.required' => 'Pole data wysłania jest wymagane!',
        ];
    }
}
