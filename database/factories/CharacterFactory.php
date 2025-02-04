<?php

namespace Database\Factories;

use App\Models\Character;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    protected $model = Character::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName,
            'enemy' => $this->faker->randomElement([true, false]),
            'defence' => $this->faker->numberBetween(0, 3),
            'strength' => $this->faker->numberBetween(0, 20),
            'accuracy' => $this->faker->numberBetween(0, 20),
            'magic' => $this->faker->numberBetween(0, 20),
            'user_id' => User::all()->random()->id,
        ];
    }

    /**
     * Customize the factory after resolving the default states.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Character $character) {
            $totalAttributes = $character->defence + $character->strength + $character->accuracy + $character->magic;
            if ($totalAttributes > 20) {
                $ratio = 20 / $totalAttributes;
                $character->defence = (int) ($character->defence * $ratio);
                $character->strength = (int) ($character->strength * $ratio);
                $character->accuracy = (int) ($character->accuracy * $ratio);
                $character->magic = (int) ($character->magic * $ratio);
            }
        });
    }
}
