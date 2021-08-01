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

    public function sumRanking()
    {
        return $this->sum('ranking');
    }

    public function assignTo($teams)
    {
        $this
            ->sorted()
            ->each(function ($player) use ($teams) {
                $highestRankedTeam = $teams->highestRanked();
                if ($highestRankedTeam->canAddPlayer()) $highestRankedTeam->add(player: $player);
            });
    }

    private function ranked(): self
    {
        $goalieIds = $this->goalies()->pluck('id')->all();
        return $this->whereNotIn('id', $goalieIds)->sortByDesc('ranking');
    }

    private function sorted(): self
    {
        return $this->goalies()->concat($this->ranked());
    }
}
