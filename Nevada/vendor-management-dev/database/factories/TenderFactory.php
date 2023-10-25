<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tender>
 */
class TenderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pdf = 'sample.pdf';
        $date = date('Y-m-d');
        $rand = rand(-10, 10);

        return [
            'date_start' => $date,
            'project_id' => 1,
            'date_end' => date('Y-m-d', strtotime("$date + $rand days")),
            'description' => fake()->paragraphs(3, true),
            'tor_doc' => $pdf,
            'support_doc' => $pdf,
        ];
    }
}
