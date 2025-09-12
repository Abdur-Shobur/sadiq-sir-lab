<?php
namespace App\Console\Commands;

use App\Models\Role;
use App\Models\Team;
use Illuminate\Console\Command;

class AssignTeamRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'team:assign-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign roles to existing team members based on their legacy role field';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to assign roles to team members...');

        $teams    = Team::all();
        $assigned = 0;

        foreach ($teams as $team) {
            $roleSlug = $this->mapLegacyRole($team->role);
            $role     = Role::where('slug', $roleSlug)->first();

            if ($role) {
                // Check if team already has this role
                if (! $team->hasRole($role->slug)) {
                    $team->assignRole($role);
                    $assigned++;
                    $this->line("Assigned {$role->name} role to {$team->name}");
                } else {
                    $this->line("{$team->name} already has {$role->name} role");
                }
            } else {
                $this->error("Role '{$roleSlug}' not found for team member {$team->name}");
            }
        }

        $this->info("Successfully assigned roles to {$assigned} team members.");
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
