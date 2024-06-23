<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Override;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[Override]
    public function definition(): array
    {
        return [
            'username' => $this->faker->userName(),
        ];
    }
}
