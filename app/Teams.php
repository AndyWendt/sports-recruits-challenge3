<?php

namespace App;

use Illuminate\Support\Collection;

class Teams extends Collection
{

    public static function from(Players $players)
    {
        $teamCount = (new TeamsCount())->for($players);

        $teams = (new self())
            ->times($teamCount)
            ->map(fn() => Team::instance());

        $players->assignTo(teams: $teams);

        return $teams;
    }

    public function highestRanked()
    {
        return $this->sort(fn($teamA, $teamB) => $teamA->ranking() <=> $teamB->ranking())->first();
    }
}
