<?php

namespace App\Http\Requests\PoSpk;

use Illuminate\Foundation\Http\FormRequest;

class NeedPoSpkRequest extends FormRequest
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
            'tor_vendor_doc' => 'required|mimes:pdf,docx|max:2048',
            'boq_final_vendor' => 'required|mimes:pdf,docx|max:2048'
        ];
    }
}
