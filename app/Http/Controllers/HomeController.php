<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Contest;

class HomeController extends Controller
{
    public function welcome()
    {
        $totalCharacters = Character::count();
        $totalContests = Contest::count();

        return view('welcome', compact('totalCharacters', 'totalContests'));
    }
}
