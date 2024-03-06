<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            if ($user->email !== 'admin@example.com' && $user->email !== 'manager@example.com') {
                DB::table('role_user')->insert(
                    ['role_id' => Role::where('name', 'User')->first()->id, 'user_id' => $user->id],
                );
            }

            if ($user->email === 'admin@example.com') {
                DB::table('role_user')->insert(
                    ['role_id' => Role::where('name', 'Admin')->first()->id, 'user_id' => $user->id],
                );
            }

            if ($user->email === 'manager@example.com') {
                DB::table('role_user')->insert(
                    ['role_id' => Role::where('name', 'Content Manager')->first()->id, 'user_id' => $user->id],
                );
            }
        });
    }
}
