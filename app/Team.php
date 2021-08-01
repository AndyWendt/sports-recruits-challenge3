<?php

namespace App;

use Faker\Factory as Faker;

class Team
{
    public const MIN_PLAYERS = 18;
    public const MAX_PLAYERS = 22;

    public static function instance()
    {
        return new self(name: Faker::create()->company, players: new Players());
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

    public function ranking()
    {
        return $this->players->sumRanking();
    }

    public function canAddPlayer()
    {
        return $this->players->count() < self::MAX_PLAYERS;
    }

    public function add($player)
    {
        $this->players->push($player);
    }
}
