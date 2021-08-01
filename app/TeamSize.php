<?php

namespace App;

use function collect;
use function range;

class TeamSize
{

    public function __construct(private $players) {}

    public function numberOfTeams(): int
    {
        return min($this->players->goalies()->count(), $this->maxPossibleTeams());
    }

    private function maxPossibleTeams(): int
    {
        $numberOfTeamsForTeamSize = fn($teamSize) => (int) floor($this->players->count() / $teamSize);
        $oddNumberOfTeams = fn($numberOfTeams) => $numberOfTeams % 2 !== 0;

        return collect(range(Teams::MIN_PLAYERS, Teams::MAX_PLAYERS))
            ->map($numberOfTeamsForTeamSize)
            ->reject($oddNumberOfTeams)
            ->max();
    }
}
