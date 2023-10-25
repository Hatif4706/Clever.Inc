<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Role::all() as $role) {
            if ($role->name === 'Vendor') continue;

            User::create([
                'name' => fake()->name(),
                'email' => str_replace(' ', '', strtolower($role['name'])).'@gmail.com',
                'password' => Hash::make('password'),
                'phone_number' => fake()->numerify('############'),
                'profile_picture' => 'https://picsum.photos/seed/'.fake()->randomNumber(3).'/200?',
            ])->assignRole($role->name);
        }
    }
}
