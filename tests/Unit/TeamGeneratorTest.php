<?php

namespace Tests\Unit;

use App\PlayersCollection;
use App\Repositories\TeamGenerator;
use Tests\TestCase;


class TeamGeneratorTest extends TestCase
{
    /**
     * @test
     */
    public function it_determines_the_max_team_players()
    {
        $instance = new TeamGenerator(new PlayersCollection([]));
        $result = $instance->maxTeamPlayers();
        $this->assertSame(TeamGenerator::MAX_TEAM_SIZE, $result);
    }
}
