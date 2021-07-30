<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

class PlayersCollection extends Collection
{
    public function goalies()
    {
        return $this->filter(fn($player) => $player->isGoalie);
    }

    public function ranked()
    {
        $goalieIds = $this->goalies()->pluck('id')->all();
        return $this->whereNotIn('id', $goalieIds)->sortByDesc('ranking');
    }
}
