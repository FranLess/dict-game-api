<?php

namespace Database\Factories;

use App\Models\User;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Friend>
 */
class FriendFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender_id' => FactoryHelper::getRandomModelId(User::class),
            'receptor_id' => FactoryHelper::getRandomModelId(User::class),
            'is_accepted' => false,
            'is_read' => false,
        ];
    }
}
