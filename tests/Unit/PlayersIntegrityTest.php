<?php

namespace Tests\Unit;

use App\Repositories\TeamsRepository;
use App\User;
use Tests\TestCase;


class PlayersIntegrityTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGoaliePlayersExist () 
    {
/*
		Check there are players that have can_play_goalie set as 1   
*/
		$result = User::where('user_type', 'player')->where('can_play_goalie', 1)->count();
		$this->assertTrue($result > 1);
    }

    // Test teams generation functional.
    public function testAtLeastOneGoaliePlayerPerTeam () 
    {
        /*
        calculate how many teams can be made so that there is an even number of teams and they each have between 18-22 players.
        Then check that there are at least as many players who can play goalie as there are teams
        */

        $players = User::ofPlayers()->get();
        
        $teams = (new TeamsRepository)->fetchTeams($players);

        // Check even number of teams
        $this->assertTrue($teams->isEven());

        // Check to make sure all teams are within the allowed range of players
        $outOfPlayersRange = $teams->filter(function($value) {
            return $value->get('players')->count() < 18 || $value->get('players')->count() > 22;
        })->all();

        $this->assertEmpty($outOfPlayersRange);

        // Check to make sure each team has at least one goalie
        $missingGoalie = $teams->filter(function($value) {
            return $value->get('players')->where('isGoalie')->isEmpty();
        })->all();

        $this->assertEmpty($missingGoalie);
    }
}
