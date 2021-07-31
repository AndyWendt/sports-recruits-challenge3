<?php

namespace App;

use App\AssignPlayers;
use App\Players;
use App\TeamSize;
use App\Team;
use Illuminate\Support\Collection;

class Teams extends Collection
{
    public static function from(Players $players)
    {
        $teams = (new self())
            ->times((new TeamSize($players))->numberOfTeams())
            ->map(fn() => Team::instance());

        $players->assignTo(teams: $teams);

        return $teams;
    }
}
