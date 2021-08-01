<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

class Players extends Collection
{
    public function goalies(): self
    {
        return $this->filter(fn($player) => $player->isGoalie)->sortByDesc('ranking');
    }

    public function averageRanking()
    {
        return $this->avg('ranking');
    }

    public function ranking()
    {
        return $this->sum('ranking');
    }

    public function assignTo(Teams $teams)
    {
        $this
            ->rankedGoaliesAndPlayers()
            ->each(function ($player) use ($teams) {
                $highestRankedTeam = $teams->highestRanked();
                if ($highestRankedTeam->canAddPlayer()) $highestRankedTeam->add(player: $player);
            });
    }

    private function rankedGoaliesAndPlayers(): self
    {
        return $this->goalies()->concat($this->rankedPlayers());
    }

    private function rankedPlayers(): self
    {
        $goalieIds = $this->goalies()->pluck('id')->all();
        return $this->whereNotIn('id', $goalieIds)->sortByDesc('ranking');
    }
}
