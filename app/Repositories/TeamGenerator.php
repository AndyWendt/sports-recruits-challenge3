<?php

namespace App\Repositories;

use App\PlayersCollection;

class TeamGenerator
{
    public const MIN_TEAM_SIZE = 18;
    public const MAX_TEAM_SIZE = 22;

    public function __construct(private $players) {}

    /**
     * Return maximum number of team players
     */
    public function maxTeamPlayers(): int
    {
        return max($this->teamSizes());
    }

    /**
     * Return number of teams we can generate
     * with at least one goalie
     */
    public function getTeamNumberWithGoalies(): int
    {
        return min($this->players->goalies()->count(), $this->getMaximumPossibleTeams());
    }

    /**
     * Get available range for team size
     */
    protected function teamSizes(): array
    {
        return range(static::MIN_TEAM_SIZE, static::MAX_TEAM_SIZE);
    }

    /**
     * Figure out how many teams we will be able to generate
     * based on the players we have
     */
    protected function getMaximumPossibleTeams(): int
    {
        return collect($this->teamSizes())
            ->map(function ($value) {
                return (int)floor($this->players->count() / $value);
            })
            ->reject(function ($value) {
                return $value % 2 !== 0;
            })
            ->max();
    }
}
