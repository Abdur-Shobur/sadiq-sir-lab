<?php
namespace Database\Seeders;

use App\Models\HomeTeam;
use App\Models\Team;
use Illuminate\Database\Seeder;

class HomeTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first 4 active teams
        $teams = Team::active()->take(4)->get();

        foreach ($teams as $index => $team) {
            HomeTeam::create([
                'team_id'    => $team->id,
                'sort_order' => $index + 1,
                'is_active'  => true,
            ]);
        }
    }
}
