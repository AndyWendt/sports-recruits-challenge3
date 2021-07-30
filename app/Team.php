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

    public function toArray()
    {
        return [
            'name' => $this->name,
            'players' => $this->players,
        ];
    }
}
