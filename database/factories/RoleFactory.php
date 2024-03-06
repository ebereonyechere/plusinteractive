<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word()
        ];
    }

    /**
     * Indicate that the role is an admin.
     */
    public function admin(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Admin',
            ];
        });
    }

    /**
     * Indicate that the role is a content manager.
     */
    public function contentManager(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Content Manager',
            ];
        });
    }

    /**
     * Indicate that the role is a user.
     */
    public function user(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'User',
            ];
        });
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Role $role) {
            if ($role->name === 'Admin') {
                DB::table('permission_role')->insert([
                    [
                        'permission_id' => Permission::where('name', 'View Admin Dashboard')->first()->id,
                        'role_id' => $role->id
                    ],
                    [
                        'permission_id' => Permission::where('name', 'Administer Users')->first()->id,
                        'role_id' => $role->id
                    ],
                ]);
            }

            if ($role->name === 'Content Manager') {
                DB::table('permission_role')->insert(
                    [
                        'permission_id' => Permission::where('name', 'View Admin Dashboard')->first()->id,
                        'role_id' => $role->id
                    ],
                );
            }
        });
    }
}
