<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Level;
use App\Models\Sentimental;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'day_of_birth' => fake()->date(),
            'gender' => fake()->randomElement(['male', 'female']),
            'country_id' => FactoryHelper::getRandomModelId(Country::class),
            'image' => fake()->imageUrl(),
            'image_header' => fake()->imageUrl(),
            'title' => fake()->title(),
            'bio' => fake()->text(),
            'likes' => fake()->numberBetween(0, 100),
            'dislikes' => fake()->numberBetween(0, 100),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'public_email' => fake()->email(),
            'user_id' => fake()->numberBetween(1, 10),
            'level_id' => FactoryHelper::getRandomModelId(Level::class),
            'sentimental_id' => FactoryHelper::getRandomModelId(Sentimental::class),
        ];
    }
}
