<?php

namespace App\Http\Controllers;

use App\Repositories\Teams;
use App\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $players = User::players();

        $teams = (new Teams($players))->generate();

    	return view('teams', compact('teams'));
    }
}
