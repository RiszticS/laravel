<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Character;
use App\Models\Place;
use App\Models\Contest;
use App\Models\CharacterContest;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
            'is_admin' => true,
        ]);

        $user = User::factory()->create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);

        $userCharacters = Character::factory(3)->create(['user_id' => $user->id, 'enemy' => false]);
        $enemyCharacters = Character::factory(3)->create(['user_id' => $admin->id, 'enemy' => true]);

        $places = Place::factory(3)->create();

        $contests = Contest::factory(10)->create(['user_id' => $user->id])->each(function ($contest) use ($userCharacters, $enemyCharacters, $places) {
            $contest->place()->associate($places->random())->save();

            $userCharacter = $userCharacters->random();
            $enemyCharacter = $enemyCharacters->random();

            $contest->characters()->attach($userCharacter, ['hero_hp' => 10, 'enemy_hp' => 10]);
            $contest->characters()->attach($enemyCharacter, ['hero_hp' => 10, 'enemy_hp' => 10]);

            $winner = rand(0, 2);
            $loser = $winner === 0 ? $enemyCharacter : ($winner === 1 ? $userCharacter : $enemyCharacters->random());

            $contest->update(['win' => true]);
            CharacterContest::where('character_id', $loser->id)
                ->where('contest_id', $contest->id)
                ->update(['enemy_hp' => 0]);
        });
    }
}
