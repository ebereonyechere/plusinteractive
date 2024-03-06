<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
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
     * Indicate that the permission is a view admin dashboard.
     */
    public function viewAdmindashboard(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'View Admin Dashboard',
            ];
        });
    }

    /**
     * Indicate that the permission is a administer users.
     */
    public function administerUsers(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Administer Users',
            ];
        });
    }
}
