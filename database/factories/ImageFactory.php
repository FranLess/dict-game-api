<?php

namespace Database\Factories;

use App\Models\Level;
use App\Models\User;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'source' => fake()->imageUrl(),
            // 'name' => fake()->word(),
            'user_id' => FactoryHelper::getRandomModelId(User::class),
            // 'level_id' => FactoryHelper::getRandomModelId(Level::class),
        ];
    }
}
