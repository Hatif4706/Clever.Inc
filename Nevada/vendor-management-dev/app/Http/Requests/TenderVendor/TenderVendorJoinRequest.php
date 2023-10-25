<?php

namespace App\Http\Requests\TenderVendor;

use Illuminate\Foundation\Http\FormRequest;

class TenderVendorJoinRequest extends FormRequest
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
            'proposal_doc' => 'required|mimes:pdf,docx|max:2048',
            'boq_doc' => 'required|mimes:pdf,docx|max:2048',
        ];
    }
}
