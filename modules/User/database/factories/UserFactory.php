<?php

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\User\app\Models\User::class;

    protected static ?string $password;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            "first_name" => fake() -> firstName(),
            "last_name" => fake() -> lastName(),
            "email" => fake() -> unique() -> safeEmail(),
            "email_verified_at" => now(),
            "password" => static::$password ??= Hash::make(("password")),
            "remember_token" => Str::random(10)
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

