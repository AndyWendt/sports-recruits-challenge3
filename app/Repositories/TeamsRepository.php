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

        foreach ($this->players->sorted() as $player) {
            // re-sort teams before each assignment, assigning next best player to lowest ranked team
            $teams = $teams->sort(function ($a, $b) {
                return ($a->sum() < $b->sum()) ? -1 : 1;
            });

            $team = $teams->first();

            if ($team->canAddPlayer()) {
                $team->add(player: $player);
            }
        }

        return $teams;
    }
}
