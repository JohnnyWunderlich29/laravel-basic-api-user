<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules =  [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email'
            ],
            'password' => 'required|string|min:6'
        ];

        if ($this->method() === 'PATCH') {
            $rules['email'] = [
                'nullable',
                'email',
                'max:255',
                //'unique:users,email,' . $this->route('id')
                Rule::unique('users', 'email')->ignore($this->route('id'))
            ];

            $rules['password'] = 'nullable|string|min:6';
        }

        return $rules;
    }
}
