<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Vendor', 'color' => '#2e994a']);
        Role::create(['name' => 'Account Manager', 'color' => '#7eb5fc']);
        Role::create(['name' => 'CAM', 'color' => '#1c6cd4']);
        Role::create(['name' => 'Logistik', 'color' => '#fa9b4d']);
        Role::create(['name' => 'Chief Logistik', 'color' => '#d16206']);
        Role::create(['name' => 'Finance', 'color' => '#d13b42']);
        Role::create(['name' => 'HLM', 'color' => '#6f06d1']);
    }
}
