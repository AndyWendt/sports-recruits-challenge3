<?php

namespace Tests;

use App\Ranking;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_retrieves_the_latest_ranking()
    {
        $user = User::create(['user_type' => 'player', 'first_name' => 'foo', 'last_name' => 'bar', 'can_play_goalie' => 1]);

        Ranking::create(['user_id' => $user->id, 'ranking' => 5, 'created_at' => "2021-07-30T17:43:17.000000Z"]);
        $ranking2 = Ranking::create(['user_id' => $user->id, 'ranking' => 1, 'created_at' => "2021-07-31T17:43:17.000000Z"]);

        $this->assertSame($ranking2->ranking, $user->ranking);
    }

    /**
     * @test
     */
    public function it_returns_0_for_ranking_when_none_are_found()
    {
        $user = User::create(['user_type' => 'player', 'first_name' => 'foo', 'last_name' => 'bar', 'can_play_goalie' => 1]);
        $this->assertSame(0, $user->ranking);
    }
}
