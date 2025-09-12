<?php
namespace Database\Seeders;

use App\Models\Role;
use App\Models\Team;
use Illuminate\Database\Seeder;

class AssignTeamRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all existing team members
        $teams = Team::all();

        foreach ($teams as $team) {
            // Assign role based on the legacy role field
            $roleSlug = $this->mapLegacyRole($team->role);
            $role     = Role::where('slug', $roleSlug)->first();

            if ($role) {
                $team->assignRole($role);
            }
        }
    }

    /**
     * Map legacy role values to new role slugs
     */
    private function mapLegacyRole($legacyRole): string
    {
        return match ($legacyRole) {
            'admin'   => 'admin',
            'team'    => 'team_member',
            'advisor' => 'advisor',
            default   => 'team_member',
        };
    }
}
