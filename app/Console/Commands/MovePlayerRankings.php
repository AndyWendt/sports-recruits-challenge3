<?php

namespace App\Console\Commands;

use App\Ranking;
use App\User;
use Illuminate\Console\Command;

class MovePlayerRankings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'move:player-rankings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Moves rankings from Users table to Rankings table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        User::whereNotNull('ranking')
            ->each(fn($user) => Ranking::create(['user_id' => $user->id, 'ranking' => $user->ranking]));

        return 0;
    }
}
