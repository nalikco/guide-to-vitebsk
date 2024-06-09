<?php

namespace Database\Factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(),
            'description' => $this->faker->text(500),
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->phoneNumber(),
            'opening_hours' => 'пн-вс, 09:00-22:00',
            'instagram' => $this->faker->url(),
            'yandex_maps' => $this->faker->url(),
        ];
    }
}
