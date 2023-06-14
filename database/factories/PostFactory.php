<?php

namespace Database\Factories;

use App\Models\Level;
use App\Models\ReceptorType;
use App\Models\Team;
use App\Models\User;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(),
            'image' => fake()->imageUrl(),
            'image_source' => fake()->imageUrl(),
            'user_id' => FactoryHelper::getRandomModelId(User::class),
            'level_id' => FactoryHelper::getRandomModelId(Level::class),
            'receptor_type_id' => FactoryHelper::getRandomModelId(ReceptorType::class),
            'team_id' => FactoryHelper::getRandomModelId(Team::class),
        ];
    }
}
