<?php

namespace Database\Factories;

use App\Models\PlaceImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<PlaceImage>
 */
class PlaceImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => Str::uuid(),
            'extension' => 'png'
        ];
    }
}
