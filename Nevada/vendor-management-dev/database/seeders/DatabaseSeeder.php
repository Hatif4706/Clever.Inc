<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Notification;
use App\Models\Project;
use App\Models\Report;
use App\Models\Tender;
use App\Models\TenderProjectEvaluation;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
        ]);

        User::factory(20)
            // ->hasAttached(Notification::factory(5))
            ->has(Vendor::factory())
            ->create();

        Project::factory(50)->has(
            Tender::factory()->hasAttached(
                Vendor::all()->random(10),
                [
                    'proposal_doc' => 'sample.pdf',
                    'boq_doc' => 'sample.pdf',
                    'created_at' => now(),
                ]
            )
        )
        ->has(Report::factory(10))
        ->create();

        TenderProjectEvaluation::factory(50)->create();
    }
}
