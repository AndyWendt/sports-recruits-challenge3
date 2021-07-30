<?php

namespace App\Repositories;

use App\PlayersCollection;
use App\Team;
use Illuminate\Support\Collection;

class Teams
{
    public static function from(PlayersCollection $players)
    {
        return new self($players, new TeamSize($players));
    }

    public function __construct(private PlayersCollection $players, private TeamSize $teamSize) {}

    public function generate(): Collection
    {
        $teams = collect([])
            ->times($this->teamSize->getTeamNumberWithGoalies())
            ->map(fn() => Team::instance());

        $this->addPlayersToTeams($teams);

        return $teams;
    }

    /**
     * @param Collection $teams
     */
    protected function addPlayersToTeams(Collection $teams): void
    {
        $this->players
            ->sorted()
            ->each(function ($player) use ($teams) {
                // re-sort teams before each assignment, assigning next best player to lowest ranked team
                $team = $teams->sort(fn($a, $b) => $a->sum() <=> $b->sum())->first();

                if ($team->canAddPlayer()) $team->add(player: $player);
            });
    }
}
