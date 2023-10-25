<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VendorRequest extends FormRequest
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
            'status' => Rule::in([
                'Verified',
                'Not Verified',
                'New',
            ]),
            'sort' => Rule::in([
                'created_at',
                'updated_at',
                'name',
                'company_email',
                'website',
                'bank_reference',
            ]),
            'order' => Rule::in(['asc', 'desc']),
            'perpage' => 'integer'
        ];
    }
}
