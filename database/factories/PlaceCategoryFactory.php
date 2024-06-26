<?php

namespace Database\Factories;

use App\Models\PlaceCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PlaceCategory>
 */
class PlaceCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[\Override]
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
        ];
    }
}
