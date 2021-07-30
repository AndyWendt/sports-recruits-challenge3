<?php

namespace App\Repositories;

use App\PlayersCollection;
use Faker\Factory as Faker;
use Illuminate\Support\Collection;

class TeamsRepository
{
    const MIN_TEAM_SIZE = 18;
    const MAX_TEAM_SIZE = 22;

    protected $faker;
    public function __construct(protected Collection $players)
    {
        $this->players = new PlayersCollection($this->players);
        $this->faker = Faker::create();
    }

    public function generateTeams(): Collection
    {
        $teams = collect([])
                ->times($this->getTeamNumberWithGoalies())
                ->map(function() {
                    return [
                        'players' => collect(),
                        'name' => $this->generateTeamName()
                    ];
                })
                ->recursive();

        $players = $this->getSortedPlayers();
        $maxPlayers = $this->maxTeamPlayers();

        foreach($players as $player) {
            // re-sort teams before each assignment, assigning next best player to lowest ranked team
            $teams = $teams->sort(function ($a, $b) {
                return ($a->get('players')->sum('ranking') < $b->get('players')->sum('ranking')) ? -1 : 1;
            });
            $teamPlayers = $teams->first()->get('players');


            if(count($teamPlayers) < $maxPlayers) {
				$teamPlayers->push(collect($player->only(['fullname', 'isGoalie', 'ranking'])));
			}
        }

        // Add additional required data about the teams based on players
        $teams = $teams->map(function($value) {
            return $value->merge([
                'average' => $value->get('players')->avg('ranking'),
                'rankSum' => $value->get('players')->sum('ranking')
            ]);
        });

		return $teams;
    }

    /**
     * Generate random team name
     */
    protected function generateTeamName(): string
    {
        return $this->faker->company;
    }

    /**
     * Return a collection of sorted players
     * goalies first
     */
    protected function getSortedPlayers(): Collection
    {
    	$goaliePlayers = $this->players->goalies()->sortByDesc('ranking');

        $playersSortedByRanking = $this->playersSortedByRank($this->players, $goaliePlayers);

		return $goaliePlayers->concat($playersSortedByRanking);
    }

    /**
     * See [WELC] 138: The Case of the Hidden Method
     *
     * Promoting this to a public function to get it under test is the desire here even though we likely don't want it
     * to be a public method in an ideal situation.  This is likely the case of a missing abstraction.
     *
     *
     * @param Collection $players
     * @param Collection $goaliePlayers
     * @return Collection
     */
    public function playersSortedByRank(Collection $players, Collection $goaliePlayers): Collection
    {
        return $players->whereNotIn('id', $goaliePlayers->pluck('id')->all())->sortByDesc('ranking');
    }

    /**
     * Return number of teams we can generate
     * with at least one goalie
     */
    protected function getTeamNumberWithGoalies(): int
    {
    	return min($this->players->goalies()->count(), $this->getMaximumPossibleTeams());
    }

    /**
     * Figure out how many teams we will be able to generate
     * based on the players we have
     */
    protected function getMaximumPossibleTeams(): int
    {
        return collect($this->teamSizes())
                ->map(function($value) {
                    return (int) floor($this->players->count() / $value);
                })
                ->reject(function($value) {
                    return $value % 2 !== 0;
                })
                ->max();
    }

    /**
     * Return maximum number of team players
     */
    protected function maxTeamPlayers(): int
    {
    	return max($this->teamSizes());
    }

    /**
     * Get available range for team size
     */
    protected function teamSizes(): array
    {
        return range(static::MIN_TEAM_SIZE, static::MAX_TEAM_SIZE);
    }
}
