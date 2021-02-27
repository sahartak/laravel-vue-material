<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'first_name' => 'required|min:2|max:12',
            'last_name' => 'required|min:2|max:12',
            'email' => 'required|confirmed|min:8',
            'email_confirmation' => 'sometimes|required_with:email',
            'phone' => 'required',
            'investment_amount' => 'required|numeric',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'sometimes|required_with:password',

        ];
    }
}
