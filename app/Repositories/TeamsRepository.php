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

        $players = $this->players->sorted();
        $maxPlayers = $this->teamGenerator->maxTeamPlayers();

        foreach ($players as $player) {
            // re-sort teams before each assignment, assigning next best player to lowest ranked team
            $teams = $teams->sort(function ($a, $b) {
                return ($a->players()->sum('ranking') < $b->players()->sum('ranking')) ? -1 : 1;
            });
            $teamPlayers = $teams->first()->players();


            if (count($teamPlayers) < $maxPlayers) {
                $teamPlayers->push(collect($player->only(['fullname', 'isGoalie', 'ranking'])));
            }
        }

        return $teams;
    }
}
