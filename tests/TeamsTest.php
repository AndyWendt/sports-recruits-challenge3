<?php

namespace Tests;

use App\Players;
use App\Teams;

class TeamsTest extends TestCase
{
    /**
     * @test
     */
    public function it_determines_the_number_of_teams_possible_based_on_goalies()
    {
        $goalies = factory(\App\User::class, 2)->state('goalie')->make();
        $players = factory(\App\User::class, 42)->make();
        $combinedPlayers = new Players($players->concat($goalies));

        $instance = Teams::from($combinedPlayers);
        $this->assertSame(2, $instance->count());
    }

    /**
     * @test
     */
    public function it_determines_the_number_of_teams_possible()
    {
        $goalies = factory(\App\User::class, 6)->state('goalie')->make();
        $players = factory(\App\User::class, 88)->make();
        $combinedPlayers = new Players($players->concat($goalies));

        $instance = Teams::from($combinedPlayers);
        $this->assertSame(4, $instance->count());
    }

    /**
     * @test
     */
    public function it_ensures_there_are_an_even_number_of_teams()
    {
        $goalies = factory(\App\User::class, 20)->state('goalie')->make();
        $players = factory(\App\User::class, 240)->make();
        $combinedPlayers = new Players($players->concat($goalies));

        $instance = Teams::from($combinedPlayers);
        $this->assertSame(14, $instance->count());
    }
}
