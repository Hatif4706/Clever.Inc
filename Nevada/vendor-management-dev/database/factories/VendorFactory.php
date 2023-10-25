<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pdf = 'sample.pdf';

        return [
            'name' => fake()->company(),
            'address' => fake()->address(),
            'website' => 'https://'.fake()->domainName(),
            'bank_reference' => fake()->creditCardType(),
            'company_email' => fake()->safeEmail(),
            'incorporation_deed' => $pdf,
            'approval_deed' => $pdf,
            'siup' => $pdf,
            'registration_cert' => $pdf,
            'annual_spt_proof' => $pdf,
            'submission_pph_ssp_proof' => $pdf,
            'pkp_npwp' => $pdf,
            'domicile_letter' => $pdf,
            'company_profile' => $pdf,
            'status' => fake()->randomElement(['New', 'Verified', 'Not Verified']),
        ];
    }
}
