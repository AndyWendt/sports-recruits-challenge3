<?php

namespace App\Http\Controllers;

use App\Repositories\TeamsRepository;
use App\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    protected $repository;

    public function __construct(TeamsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $players = User::ofPlayers()->get();
        
        $teams = $this->repository->fetchTeams($players);
        
    	return view('teams', compact('teams'));
    }
}
