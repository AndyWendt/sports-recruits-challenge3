<?php

namespace Tests\Console\Commands;

use App\Console\Commands\MovePlayerRankings;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class MovePlayerRankingsTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_moves_player_rankings()
    {
        $this->markTestSkipped('using migrations instead to move the data');
        $exitCode = Artisan::call('move:player-rankings', []);
        $this->assertSame(0, $exitCode);

        User::players()
            ->map(fn($player) => ['user_id' => $player->id, 'ranking' => $player->ranking])
            ->each(fn($expected) => $this->assertDatabaseHas('rankings', $expected));
    }
}
