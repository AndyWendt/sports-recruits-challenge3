<?php

namespace Tests\Unit;

use App\TeamsCount;
use Tests\TestCase;


class TeamsCountTest extends TestCase
{
    /**
     * @test
     */
    public function it_determines_the_number_of_teams_possible_based_on_goalies()
    {
        $goaliesCount = 2;
        $players = $this->playersStub(playersCount: 42, goaliesCount: $goaliesCount);
        $result = (new TeamsCount())->for($players);
        $this->assertSame($goaliesCount, $result);
    }

    /**
     * @test
     */
    public function it_determines_the_number_of_teams_possible()
    {
        $result = (new TeamsCount())->for($this->playersStub(playersCount: 88, goaliesCount: 6));
        $this->assertSame(4, $result);
    }

    /**
     * @test
     */
    public function it_ensures_there_are_an_even_number_of_teams()
    {
        $result = (new TeamsCount())->for($this->playersStub(playersCount: 240, goaliesCount: 20));
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
