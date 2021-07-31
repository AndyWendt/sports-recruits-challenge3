<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamDistributionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_displays_team_distributions()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSeeText('Teams distribution');
        $response->assertSeeText('Player name');
        $response->assertSeeText('Goalie');
        $response->assertSeeText('Ranking');
    }

    /**
     * @test
     */
    public function it_updates_rankings()
    {
        $user = User::create(['user_type' => 'player', 'first_name' => 'foo', 'last_name' => 'bar', 'can_play_goalie' => 1]);

        $this->post(sprintf('/ranking/%s', $user->id), ['value' => 3])->assertSuccessful();
        $this->post(sprintf('/ranking/%s', $user->id), ['value' => 4])->assertSuccessful();

        $this->assertDatabaseHas('rankings', ['user_id' => $user->id, 'ranking' => 3]);
        $this->assertDatabaseHas('rankings', ['user_id' => $user->id, 'ranking' => 4]);
    }
}
