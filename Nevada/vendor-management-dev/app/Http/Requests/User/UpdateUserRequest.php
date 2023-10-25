<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'role' => 'required|integer|between:1,7',
            'password' => 'nullable|min:8',
            'profile_picture' => 'image|mimes:jpeg,png,jpg|max:2048',
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users')->ignore($this->route()->user->id)
            ],
            'phone_number' => [
                'required', 'numeric', 'max_digits:255',
                Rule::unique('users')->ignore($this->route()->user->id)
            ],
        ];
    }
}
