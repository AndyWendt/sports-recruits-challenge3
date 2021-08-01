<?php

namespace App;

use function collect;

class TeamSize
{
    public const MIN = 18;
    public const MAX = 22;

    public function __construct(private $players) {}

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
        return range(static::MIN, static::MAX);
    }

    /**
     * Figure out how many teams we will be able to generate
     * based on the players we have
     */
    protected function maxPossibleTeams(): int
    {
        $numberOfTeamsForTeamSize = fn($teamSize) => (int) floor($this->players->count() / $teamSize);
        $oddNumberOfTeams = fn($numberOfTeams) => $numberOfTeams % 2 !== 0;

        return collect($this->sizeRange())
            ->map($numberOfTeamsForTeamSize)
            ->reject($oddNumberOfTeams)
            ->max();
    }
}
