<?php

namespace Tests\Unit;

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
        $average = $instance->average();
        $sum = $instance->sum();

        $this->assertSame('3.071', $average);
        $this->assertSame(261, $sum);
    }
}
