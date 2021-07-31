<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class User extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_type', 'first_name', 'last_name'];

    /**
     * Players only local scope
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfPlayers($query): Builder
    {
        return $query->where('user_type', 'player')
            ->with('rankings');
    }

    public static function players(): PlayersCollection
    {
        return new PlayersCollection(self::ofPlayers()->get());
    }

    public function getIsGoalieAttribute(): bool
    {
        return (bool)$this->can_play_goalie;
    }

    public function getFullnameAttribute(): string
    {
        return Str::title($this->first_name . ' ' . $this->last_name);
    }

    public function getRankingAttribute()
    {
        return $this->rankings->sortByDesc('created_at')->first()->ranking ?? 0;
    }

    public function rankings()
    {
        return $this->hasMany(Ranking::class);
    }
}
