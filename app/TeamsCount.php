<?php

namespace App;

use function collect;
use function range;

class TeamsCount
{
    public function for($players): int
    {
        return min($players->goalies()->count(), $this->maxPossibleTeams($players));
    }

    private function maxPossibleTeams($players): int
    {
        $numberOfTeamsForTeamSize = fn($teamSize) => (int) floor($players->count() / $teamSize);
        $oddNumberOfTeams = fn($numberOfTeams) => $numberOfTeams % 2 !== 0;

        return collect(range(Team::MIN_PLAYERS, Team::MAX_PLAYERS))
            ->map($numberOfTeamsForTeamSize)
            ->reject($oddNumberOfTeams)
            ->max();
    }
}
