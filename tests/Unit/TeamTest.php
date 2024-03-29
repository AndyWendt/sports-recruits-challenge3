<?php

namespace Tests\Unit;

use App\Players;
use App\Team;
use App\User;
use Tests\TestCase;


class TeamTest extends TestCase
{
    /**
     * @test
     */
    public function it_determines_the_team_stats()
    {
        $instance = new Team('foo', User::players());
        $this->assertSame('3.071', $instance->averagePlayerRanking());
        $this->assertSame(261, $instance->ranking());
    }

    /**
     * @test
     */
    public function it_determines_if_you_cannot_add_a_player()
    {
        $players = new Players(factory(\App\User::class, 40)->make());
        $instance = new Team('foo', $players);
        $this->assertFalse($instance->canAddPlayer());
    }

    /**
     * @test
     */
    public function it_determines_if_you_can_add_a_player()
    {
        $this->assertTrue(Team::instance()->canAddPlayer());
    }
}
