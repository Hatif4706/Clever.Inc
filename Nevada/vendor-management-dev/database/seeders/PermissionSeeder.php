<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'see project'])->assignRole('Account Manager', 'CAM', 'Chief Logistik', 'Logistik', 'Finance', 'HLM');
        Permission::create(['name' => 'manage project'])->assignRole('Account Manager', 'CAM');
        Permission::create(['name' => 'see report'])->assignRole('CAM', 'Account Manager', 'HLM');

        Permission::create(['name' => 'see po spk'])->assignRole('Account Manager', 'CAM', 'Chief Logistik', 'Logistik', 'Finance', 'HLM');
        Permission::create(['name' => 'need po spk'])->assignRole('Account Manager', 'CAM');
        Permission::create(['name' => 'create po spk'])->assignRole('Chief Logistik', 'Logistik');
        Permission::create(['name' => 'approve po spk'])->assignRole('Chief Logistik');

        Permission::create(['name' => 'see payment'])->assignRole('Account Manager', 'CAM', 'Chief Logistik', 'Logistik', 'Finance', 'HLM');
        Permission::create(['name' => 'create payment'])->assignRole('Finance');

        Permission::create(['name' => 'see tender'])->assignRole('CAM', 'Account Manager', 'Vendor');
        Permission::create(['name' => 'manage tender'])->assignRole('CAM', 'Account Manager');
    }
}
