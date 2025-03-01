<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = [
        'win',
        'history',
        'user_id',
        'place_id',
    ];

    protected $casts = [
        'win' => 'boolean',
        'history' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class)
                    ->using(CharacterContest::class)
                    ->withPivot('hero_hp', 'enemy_hp');
    }
}
