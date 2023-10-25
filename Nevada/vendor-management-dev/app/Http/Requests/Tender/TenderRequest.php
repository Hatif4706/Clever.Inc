<?php

namespace App\Http\Requests\Tender;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TenderRequest extends FormRequest
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
                'Open',
                'Closed',
            ]),
            'sort' => Rule::in([
                'created_at',
                'updated_at',
                'project_name',
                'date_start',
                'date_end',
            ]),
            'order' => Rule::in(['asc', 'desc']),
            'perpage' => 'integer'

        ];
    }
}
