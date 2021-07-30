<?php

namespace Tests\Unit;

use App\PlayersCollection;
use App\User;
use Tests\TestCase;


class PlayersCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function it_determines_the_goalies()
    {
        $players = User::ofPlayers()->get();

        $instance = new PlayersCollection($players);
        $result = $instance->goalies();

        $goalies = $players->where('can_play_goalie', 1);
        $this->assertEquals($goalies->toArray(), $result->toArray());
    }

    /**
     * @test
     */
    public function it_sorts_players_by_ranking_desc_and_excludes_goalies()
    {
        $players = User::ofPlayers()->get();

        $instance = new PlayersCollection($players);
        $result = $instance->ranked();

        $goalies = $instance->goalies();
        $this->assertGreaterThan(0, $goalies->count());
        $this->assertCount(0, $result->intersect($goalies), 'There should be no goalies in the sorted by rank results');

        $rankings = $result->pluck('ranking');
        $this->assertTrue(true);
        $this->assertSame($rankings->sortDesc()->toArray(), $rankings->toArray());
    }
}
