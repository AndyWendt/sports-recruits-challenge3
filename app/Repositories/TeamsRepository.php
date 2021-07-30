<?php

namespace App\Repositories;

use App\PlayersCollection;
use App\Team;
use Illuminate\Support\Collection;

class TeamsRepository
{

    protected $faker;
    private TeamGenerator $teamGenerator;

    public function __construct(private PlayersCollection $players)
    {
        $this->teamGenerator = new TeamGenerator($players);
    }

    public function generateTeams(): Collection
    {
        $teams = collect([])
            ->times($this->teamGenerator->getTeamNumberWithGoalies())
            ->map(fn() => Team::instance());

        $this->players
            ->sorted()
            ->each(function ($player) use ($teams) {
                // re-sort teams before each assignment, assigning next best player to lowest ranked team
                $team = $teams->sort(function ($a, $b) {
                    return ($a->sum() < $b->sum()) ? -1 : 1;
                })->first();

                if ($team->canAddPlayer()) $team->add(player: $player);
            });

        return $teams;
    }
}
