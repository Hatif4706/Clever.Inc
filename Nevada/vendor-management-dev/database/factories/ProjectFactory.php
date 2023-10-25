<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
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
            'assign_pic_am' => 1,
            'name' => ucfirst(fake('en_US')->domainWord()),
            'job' => fake()->jobTitle(),
            'user_company' => fake()->company(),
            'pic_company' => fake()->company(),
            'pic_company_phone_number' => fake()->numerify('############'),
            'contract_number' => fake()->numerify(),
            'contract_date' => fake()->date(),
            'contract_rate' => fake()->randomNumber(7, true),
            'vendor_deal' => round(rand(100_000, 10_000_000), -5),
            'tor_vendor_doc' => $pdf,
            'boq_final_vendor' => $pdf,
            'evaluation_project_doc' => $pdf,
            'ba_reconciliation_doc' => $pdf,
            'bast_doc' => $pdf,
            'tor_doc_status' => fake()->randomElement(['Available', 'Not Available']),
            'po_doc_status' => fake()->randomElement(['Available', 'Not Available']),
            'payment_status' => fake()->randomElement(['Done', 'Not Available']),
            'status' => fake()->randomElement([
                'New Project',
                'Tender on Process',
                'Need evaluation',
                'Need PO & SPK',
                'Need Closing',
                'Payment Updated',
                'Completed',
            ]),
        ];
    }
}
