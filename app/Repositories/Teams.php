<?php

namespace App\Repositories;

use App\AssignPlayers;
use App\PlayersCollection;
use App\Team;
use Illuminate\Support\Collection;

class Teams extends Collection
{
    public static function from(PlayersCollection $players)
    {

        $teams = (new self())
            ->times((new TeamSize($players))->numberOfTeams())
            ->map(fn() => Team::instance());

        $players->assignTo(teams: $teams);

        return $teams;
    }
}
