<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class NeedClosingProjectRequest extends FormRequest
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
            'evaluation_project_doc' => 'required|mimes:pdf,docx|max:2048',
            'ba_reconciliation_doc' => 'required|mimes:pdf,docx|max:2048',
            'bast_doc' => 'required|mimes:pdf,docx|max:2048'
        ];
    }
}
