<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class StoreUserRequest extends FormRequest
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
        $nameRoute = Route::currentRouteName();
        return [
            'name' => 'required',
            'login' => 'required',
            'password' => $nameRoute == 'users.update' ? '' : 'required',
            'id_profile' => 'required',
            'id_actions' => 'required',
            'email' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors(), 'tipo' => 'Validação de Campo'], Response::HTTP_NOT_ACCEPTABLE)
        );
    }
}
