<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

class Players extends Collection
{
    public function goalies(): self
    {
        return $this->filter(fn($player) => $player->isGoalie)->sortByDesc('ranking');
    }

    public function ranked(): self
    {
        $goalieIds = $this->goalies()->pluck('id')->all();
        return $this->whereNotIn('id', $goalieIds)->sortByDesc('ranking');
    }

    public function sorted(): self
    {
        return $this->goalies()->concat($this->ranked());
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
                // re-sort teams before each assignment, assigning next best player to lowest ranked team
                $team = $teams->sort(fn($a, $b) => $a->sum() <=> $b->sum())->first();

                if ($team->canAddPlayer()) $team->add(player: $player);
            });
    }
}
