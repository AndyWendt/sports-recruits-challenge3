<?php

namespace App;

use Faker\Factory as Faker;

class Team
{
    public static function instance()
    {
        return new self(name: Faker::create()->company, players: collect());
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
        return number_format($this->players->avg('ranking'), 3);
    }

    public function sum()
    {
        return $this->players->sum('ranking');
    }
}
