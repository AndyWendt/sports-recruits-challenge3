<?php

namespace App;

use function collect;

class TeamSize
{
    public const MIN_PLAYERS = 18;
    public const MAX_PLAYERS = 22;

    public function __construct(private $players) {}

    public function numberOfTeams(): int
    {
        return min($this->players->goalies()->count(), $this->maxPossibleTeams());
    }

    private function maxPossibleTeams(): int
    {
        $numberOfTeamsForTeamSize = fn($teamSize) => (int) floor($this->players->count() / $teamSize);
        $oddNumberOfTeams = fn($numberOfTeams) => $numberOfTeams % 2 !== 0;

        return collect($this->sizeRange())
            ->map($numberOfTeamsForTeamSize)
            ->reject($oddNumberOfTeams)
            ->max();
    }

    private function sizeRange(): array
    {
        return range(static::MIN_PLAYERS, static::MAX_PLAYERS);
    }
}
