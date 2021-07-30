<?php

namespace App;

use App\Repositories\TeamSize;
use Faker\Factory as Faker;

class Team
{
    public static function instance()
    {
        return new self(name: Faker::create()->company, players: new PlayersCollection());
    }

    public function __construct(private $name, private $players) {}

    public function players()
    {
        return $this->players;
    }

    public function name()
    {
        return $this->name;
    }

    public function average()
    {
        return number_format($this->players->averageRanking(), 3);
    }

    public function sum()
    {
        return $this->players->sumRanking();
    }

    public function canAddPlayer()
    {
        return $this->players->count() < TeamSize::MAX_TEAM_SIZE;
    }

    public function add($player)
    {
        $this->players->push($player);
    }
}
