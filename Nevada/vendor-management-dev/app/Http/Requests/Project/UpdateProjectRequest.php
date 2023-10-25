<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'job' => 'required|string|max:255',
            'user_company' => 'required|string|max:255',
            'pic_company' => 'required|string|max:255',
            'pic_company_phone_number' => 'required|numeric|max_digits:255',
            'contract_number' => 'required|numeric|max_digits:255',
            'contract_date' => 'required|date',
            'contract_rate' => 'required|numeric',
            'vendor_deal' => 'required|string|max:255',
            'assign_pic_am' => 'required',
        ];
    }
}
