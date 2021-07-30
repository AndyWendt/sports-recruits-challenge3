<?php

namespace Tests\Unit;

use App\PlayersCollection;
use App\Repositories\TeamSize;
use Tests\TestCase;


class TeamSizeTest extends TestCase
{
    /**
     * @test
     */
    public function it_determines_the_max_team_players()
    {
        $instance = new TeamSize(new PlayersCollection([]));
        $result = $instance->maxTeamPlayers();
        $this->assertSame(TeamSize::MAX_TEAM_SIZE, $result);
    }

    /**
     * @test
     */
    public function it_determines_the_number_of_teams_possible_based_on_goalies()
    {
        $goaliesCount = 2;
        $instance = new TeamSize($this->playersStub(playersCount: 42, goaliesCount: $goaliesCount));
        $result = $instance->getTeamNumberWithGoalies();
        $this->assertSame($goaliesCount, $result);
    }

    /**
     * @test
     */
    public function it_determines_the_number_of_teams_possible()
    {
        $instance = new TeamSize($this->playersStub(playersCount: 88, goaliesCount: 6));
        $result = $instance->getTeamNumberWithGoalies();
        $this->assertSame(4, $result);
    }

    /**
     * @test
     */
    public function it_ensures_there_are_an_even_number_of_teams()
    {
        $instance = new TeamSize($this->playersStub(playersCount: 240, goaliesCount: 20));
        $result = $instance->getTeamNumberWithGoalies();
        $this->assertSame(12, $result);
    }

    public function playersStub($playersCount, $goaliesCount)
    {
        return new class($playersCount, $goaliesCount) {

            public function __construct(private int $playersCount, private int $goaliesCount)
            {
            }

            public function goalies()
            {
                return new class($this->goaliesCount) {
                    public function __construct(private $goaliesCount) {}
                    public function count()
                    {
                        return $this->goaliesCount;
                    }
                };
            }

            public function count()
            {
                return $this->playersCount;
            }
        };
    }
}
