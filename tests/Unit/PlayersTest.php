<?php

namespace Tests\Unit;

use App\Players;
use App\Team;
use App\Teams;
use Tests\TestCase;


class PlayersTest extends TestCase
{
    /**
     * @test
     */
    public function it_determines_the_goalies()
    {
        $player = $this->playerStub();
        $goalie = $this->playerStub(isGoalie: true);

        $result = (new Players([$player, $goalie]))->goalies();

        $this->assertCount(1, $result);
        $this->assertSame($goalie, $result->first());
    }

    /**
     * @test
     */
    public function it_assigns_players_to_teams()
    {
        $player1 = $this->playerStub(ranking: 5);
        $player2 = $this->playerStub(ranking: 5);
        $player3 = $this->playerStub(ranking: 4);
        $player4 = $this->playerStub(ranking: 3);

        $goalie1 = $this->playerStub(ranking: 4, isGoalie: true);
        $goalie2 = $this->playerStub(ranking: 1, isGoalie: true);

        $players = new Players([
            $player4,
            $player1,
            $player3,
            $goalie2,
            $player2,
            $goalie1,
        ]);

        $team1 = Team::instance();
        $team2 = Team::instance();


        (new Players($players))->assignTo(new Teams([$team1, $team2]));

        $this->assertSame($team1->players()[0], $goalie1);
        $this->assertSame($team1->players()[1], $player2);
        $this->assertSame($team1->players()[2], $player4);

        $this->assertSame($team2->players()[0], $goalie2);
        $this->assertSame($team2->players()[1], $player1);
        $this->assertSame($team2->players()[2], $player3);
    }

    /**
     * @test
     */
    public function it_restricts_the_number_of_players_on_a_team()
    {
        $players = array_fill(0, 100, $this->playerStub(ranking: mt_rand(1, 5)));

        $team1 = Team::instance();
        $team2 = Team::instance();


        (new Players($players))->assignTo(new Teams([$team1, $team2]));

        $this->assertCount(Team::MAX_PLAYERS, $team1->players());
        $this->assertCount(Team::MAX_PLAYERS, $team2->players());
    }

    private function playerStub($ranking = 5, $isGoalie = false)
    {
        return (object) ['id' => mt_rand(), 'ranking' => $ranking, 'isGoalie' => $isGoalie];
    }
}
