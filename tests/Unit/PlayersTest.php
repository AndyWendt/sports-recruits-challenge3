<?php

namespace Tests\Unit;

use App\Players;
use App\User;
use Tests\TestCase;


class PlayersTest extends TestCase
{
    /**
     * @test
     */
    public function it_determines_the_goalies()
    {
        $players = User::ofPlayers()->get();
        $result = (new Players($players->reverse()))->goalies();

        $expected = $players->filter(fn($player) => $player->isGoalie)->sortByDesc('ranking');
        $this->assertEquals($expected->pluck('ranking')->toArray(), $result->pluck('ranking')->toArray());
    }

    /**
     * @test
     */
    public function it_sorts_players_by_ranking_desc_and_excludes_goalies()
    {
        $instance = User::players();
        $result = $instance->ranked();

        $goalies = $instance->goalies();
        $this->assertGreaterThan(0, $goalies->count());
        $this->assertCount(0, $result->intersect($goalies), 'There should be no goalies in the sorted by rank results');

        $rankings = $result->pluck('ranking');
        $this->assertTrue(true);
        $this->assertSame($rankings->sortDesc()->toArray(), $rankings->toArray());
    }
}
