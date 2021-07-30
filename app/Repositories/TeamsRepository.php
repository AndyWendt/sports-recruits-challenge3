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
            ->map(fn() => Team::instance()->toArray())
            ->recursive();

        $players = $this->players->sorted();
        $maxPlayers = $this->teamGenerator->maxTeamPlayers();

        foreach ($players as $player) {
            // re-sort teams before each assignment, assigning next best player to lowest ranked team
            $teams = $teams->sort(function ($a, $b) {
                return ($a->get('players')->sum('ranking') < $b->get('players')->sum('ranking')) ? -1 : 1;
            });
            $teamPlayers = $teams->first()->get('players');


            if (count($teamPlayers) < $maxPlayers) {
                $teamPlayers->push(collect($player->only(['fullname', 'isGoalie', 'ranking'])));
            }
        }

        // Add additional required data about the teams based on players
        $teams = $teams->map(function ($value) {
            return $value->merge([
                'average' => $value->get('players')->avg('ranking'),
                'rankSum' => $value->get('players')->sum('ranking')
            ]);
        });

        return $teams;
    }
}
