<?php

namespace Database\Factories;

use App\Models\Tender;
use App\Models\TenderProjectEvaluation;
use App\Models\TenderVendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TenderProjectEvaluation>
 */
class TenderProjectEvaluationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pdf = 'sample.pdf';
        $tender = Tender::all()->random();
        $tenderVendor = TenderVendor::find(
            $tender->vendors->random()->pivot->id
        );

        return [
            'tender_id' => $tender->id,
            'tender_vendor_id' => $tenderVendor->id,
            'technical_evaluation_doc' => $pdf,
            // 'selected_vendor' => '',
            'approval' => fake()->randomElement(['Approved', 'Rejected']),
            'reason' => fake()->words(10, true),
            'status' => fake()->randomElement(['Need PO & SPK', 'Need Approval PO & SPK', 'Need Closing'])
        ];
    }
}
