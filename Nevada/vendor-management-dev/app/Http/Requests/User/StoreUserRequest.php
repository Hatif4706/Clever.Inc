<?php

namespace App\Http\Requests\User;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'profile_picture' => 'image|mimes:jpg,jpeg,png|max:2048',
            'role' => 'required|integer|between:2,7',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phone_number' => 'required|numeric|max_digits:255',
            'password' => 'required|min:8',
        ];
    }
}
