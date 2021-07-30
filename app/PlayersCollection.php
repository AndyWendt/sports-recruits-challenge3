<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

class PlayersCollection extends Collection
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
}
