<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(98)->create();

        // Will be given admin role
        User::factory()->create([
            'email' => 'admin@example.com'
        ]);

        // Will be given Content Manager role
        User::factory()->create([
            'email' => 'manager@example.com'
        ]);
    }
}
