<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
class RegisterUserRequest extends FormRequest
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
            'name' => 'required',
            'login' => 'required',
            'password' => 'required',
            'email' => 'required',
        ];
    }

    public function messages()
    {
        return [
        ];
    }

    protected function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors(), 'tipo' => 'Validação de Campo'], Response::HTTP_NOT_ACCEPTABLE)
        );
    }
}
