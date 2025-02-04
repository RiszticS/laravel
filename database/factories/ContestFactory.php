<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contest>
 */
class ContestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'win' => $this->faker->boolean,
            'history' => $this->faker->paragraph,
            'user_id' => User::factory()->create()->id,
            'place_id' => Place::factory()->create()->id,
        ];
    }
}
