<?php

namespace App\Http\Controllers;

use App\Repositories\TeamsRepository;
use App\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $players = User::ofPlayers()->get();

        $teams = (new TeamsRepository($players))->generateTeams();

    	return view('teams', compact('teams'));
    }
}
