<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

class PlayersCollection extends Collection
{
    public function goalies()
    {
        return $this->where('can_play_goalie', 1);
    }

    public function ranked()
    {
        return $this->whereNotIn('id', $this->goalies()->pluck('id')->all())->sortByDesc('ranking');
    }
}
