<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamDistributionTest extends TestCase
{
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
}
