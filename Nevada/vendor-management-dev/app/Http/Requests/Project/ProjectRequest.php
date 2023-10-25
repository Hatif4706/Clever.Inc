<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
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
                'New Project',
                'Tender on Process',
                'Need Evaluation',
                'Need PO & SPK',
                'Need Closing',
                'Payment Updated',
                'Completed',
            ]),
            'sort' => Rule::in([
                'created_at',
                'updated_at',
                'name',
                'contract_date',
                'contract_number',
                'contract_rate',
                'vendor_deal',
            ]),
            'order' => Rule::in(['asc', 'desc']),
            'perpage' => 'integer'
        ];
    }
}
