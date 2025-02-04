<?php

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Character;
use App\Models\Contest;

class CharacterContestFactory extends Factory
{
    protected $model = Character::class;

    public function definition()
    {
        return [
            'hero_hp' => $this->faker->numberBetween(0, 20),
            'enemy_hp' => $this->faker->numberBetween(0, 20),
            'character_id' => Character::factory()->create()->id,
            'contest_id' => Contest::factory()->create()->id,
        ];
    }
}
