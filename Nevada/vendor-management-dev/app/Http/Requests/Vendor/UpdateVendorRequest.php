<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorRequest extends FormRequest
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
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'website' => 'required|url|max:255',
            'company_email' => 'required|email|max:255',
            'bank_reference' => 'required|max:255',
            'incorporation_deed' => 'mimes:pdf,jpg,jpeg|max:2048',
            'approval_deed' => 'mimes:pdf,jpg,jpeg|max:2048',
            'siup' => 'mimes:pdf,jpg,jpeg|max:2048',
            'registration_cert' => 'mimes:pdf,jpg,jpeg|max:2048',
            'annual_spt_proof' => 'mimes:pdf,jpg,jpeg|max:2048',
            'submission_pph_ssp_proof' => 'mimes:pdf,jpg,jpeg|max:2048',
            'pkp_npwp' => 'mimes:pdf,jpg,jpeg|max:2048',
            'domicile_letter' => 'mimes:pdf,jpg,jpeg|max:2048',
            'company_profile' => 'mimes:pdf,jpg,jpeg|max:2048',
        ];
    }
}
