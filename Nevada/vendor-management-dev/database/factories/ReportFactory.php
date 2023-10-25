<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => fake()->randomDigitNotNull(),
            'user_id' => fake()->randomDigitNotNull(),
            'action' => fake()->words(2, true),
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
