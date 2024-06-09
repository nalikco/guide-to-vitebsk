<?php

namespace Database\Factories;

use App\Models\TelegramUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TelegramUser>
 */
class TelegramUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'telegram_id' => rand(100000, 999999),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'username' => fake()->userName(),
            'language_code' => fake()->languageCode(),
        ];
    }
}
