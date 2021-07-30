<?php

namespace App\Repositories;

class TeamSize
{
    public const MIN_TEAM_SIZE = 18;
    public const MAX_TEAM_SIZE = 22;

    public function __construct(private $players) {}

    /**
     * Return maximum number of team players
     */
    public function max(): int
    {
        return max($this->sizeRange());
    }

    /**
     * Return number of teams we can generate
     * with at least one goalie
     */
    public function numberOfTeams(): int
    {
        return min($this->players->goalies()->count(), $this->maxPossibleTeams());
    }

    /**
     * Get available range for team size
     */
    protected function sizeRange(): array
    {
        return range(static::MIN_TEAM_SIZE, static::MAX_TEAM_SIZE);
    }

    /**
     * Figure out how many teams we will be able to generate
     * based on the players we have
     */
    protected function maxPossibleTeams(): int
    {
        return collect($this->sizeRange())
            ->map(function ($value) {
                return (int)floor($this->players->count() / $value);
            })
            ->reject(function ($value) {
                return $value % 2 !== 0;
            })
            ->max();
    }
}
