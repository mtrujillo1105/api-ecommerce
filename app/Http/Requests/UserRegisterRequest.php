<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];
    }

    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(
            response()->json(
                [
                    'status' => false,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors()
                ],
                400
            )
        );
    }

    public function messages()
    {
        return [
            'name.required' => 'Code es requerido',
            'email.required' => 'Email es requerido',
            'email.unique' => 'Email ya fue registrado',
            'password.required' => 'Code es requerido',
            'password.min' => 'Password mayor a 6 caracteres'
        ];
    }
}
