<?php

namespace Database\Factories;

use App\Models\PlaceRate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PlaceRate>
 */
class PlaceRateFactory extends Factory
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
            'rate' => random_int(1, 5),
        ];
    }
}
