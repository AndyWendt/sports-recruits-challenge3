<?php

namespace App;

use Illuminate\Support\Collection;

class Teams extends Collection
{

    public static function from(Players $players)
    {
        $teamCount = (new TeamsCount())->for($players);

        return (new self())
            ->times($teamCount)
            ->map(fn() => Team::instance())
            ->tap(fn($teams) => $players->assignTo(teams: $teams));
    }

    public function highestRanked()
    {
        return $this->sort(fn($teamA, $teamB) => $teamA->ranking() <=> $teamB->ranking())->first();
    }
}
