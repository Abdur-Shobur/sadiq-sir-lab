<?php
namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create Permissions
        $permissions = [
            // Research permissions
            ['name' => 'View Research', 'slug' => 'research.view', 'module' => 'research'],
            ['name' => 'Create Research', 'slug' => 'research.create', 'module' => 'research'],
            ['name' => 'Edit Research', 'slug' => 'research.edit', 'module' => 'research'],
            ['name' => 'Delete Research', 'slug' => 'research.delete', 'module' => 'research'],

            // Team permissions
            ['name' => 'View Team', 'slug' => 'team.view', 'module' => 'team'],
            ['name' => 'Create Team', 'slug' => 'team.create', 'module' => 'team'],
            ['name' => 'Edit Team', 'slug' => 'team.edit', 'module' => 'team'],
            ['name' => 'Delete Team', 'slug' => 'team.delete', 'module' => 'team'],

            // Blog permissions
            ['name' => 'View Blog', 'slug' => 'blog.view', 'module' => 'blog'],
            ['name' => 'Create Blog', 'slug' => 'blog.create', 'module' => 'blog'],
            ['name' => 'Edit Blog', 'slug' => 'blog.edit', 'module' => 'blog'],
            ['name' => 'Delete Blog', 'slug' => 'blog.delete', 'module' => 'blog'],

            // News permissions
            ['name' => 'View News', 'slug' => 'news.view', 'module' => 'news'],
            ['name' => 'Create News', 'slug' => 'news.create', 'module' => 'news'],
            ['name' => 'Edit News', 'slug' => 'news.edit', 'module' => 'news'],
            ['name' => 'Delete News', 'slug' => 'news.delete', 'module' => 'news'],

            // Event permissions
            ['name' => 'View Event', 'slug' => 'event.view', 'module' => 'event'],
            ['name' => 'Create Event', 'slug' => 'event.create', 'module' => 'event'],
            ['name' => 'Edit Event', 'slug' => 'event.edit', 'module' => 'event'],
            ['name' => 'Delete Event', 'slug' => 'event.delete', 'module' => 'event'],

            // Project permissions
            ['name' => 'View Project', 'slug' => 'project.view', 'module' => 'project'],
            ['name' => 'Create Project', 'slug' => 'project.create', 'module' => 'project'],
            ['name' => 'Edit Project', 'slug' => 'project.edit', 'module' => 'project'],
            ['name' => 'Delete Project', 'slug' => 'project.delete', 'module' => 'project'],

            // Gallery permissions
            ['name' => 'View Gallery', 'slug' => 'gallery.view', 'module' => 'gallery'],
            ['name' => 'Create Gallery', 'slug' => 'gallery.create', 'module' => 'gallery'],
            ['name' => 'Edit Gallery', 'slug' => 'gallery.edit', 'module' => 'gallery'],
            ['name' => 'Delete Gallery', 'slug' => 'gallery.delete', 'module' => 'gallery'],

            // Service permissions
            ['name' => 'View Service', 'slug' => 'service.view', 'module' => 'service'],
            ['name' => 'Create Service', 'slug' => 'service.create', 'module' => 'service'],
            ['name' => 'Edit Service', 'slug' => 'service.edit', 'module' => 'service'],
            ['name' => 'Delete Service', 'slug' => 'service.delete', 'module' => 'service'],

            // Contact permissions
            ['name' => 'View Contact', 'slug' => 'contact.view', 'module' => 'contact'],
            ['name' => 'Edit Contact', 'slug' => 'contact.edit', 'module' => 'contact'],

            // Newsletter permissions
            ['name' => 'View Newsletter', 'slug' => 'newsletter.view', 'module' => 'newsletter'],
            ['name' => 'Edit Newsletter', 'slug' => 'newsletter.edit', 'module' => 'newsletter'],

            // Settings permissions
            ['name' => 'View Settings', 'slug' => 'settings.view', 'module' => 'settings'],
            ['name' => 'Edit Settings', 'slug' => 'settings.edit', 'module' => 'settings'],

            // Dashboard permissions
            ['name' => 'View Dashboard', 'slug' => 'dashboard.view', 'module' => 'dashboard'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Create Roles
        $roles = [
            ['name' => 'Admin', 'slug' => 'admin', 'description' => 'Full system access'],
            ['name' => 'Advisor', 'slug' => 'advisor', 'description' => 'Can view, create, and edit most content'],
            ['name' => 'Team Member', 'slug' => 'team_member', 'description' => 'Can view and create content'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        // Assign permissions to roles
        $adminRole      = Role::where('slug', 'admin')->first();
        $advisorRole    = Role::where('slug', 'advisor')->first();
        $teamMemberRole = Role::where('slug', 'team_member')->first();

        // Admin gets all permissions
        $adminRole->permissions()->attach(Permission::all());

        // Advisor permissions
        $advisorPermissions = Permission::whereIn('slug', [
            'research.view', 'research.create', 'research.edit',
            'blog.view', 'blog.create', 'blog.edit',
            'news.view', 'news.create', 'news.edit',
            'event.view', 'event.create', 'event.edit',
            'project.view', 'project.create', 'project.edit',
            'gallery.view', 'gallery.create', 'gallery.edit',
            'service.view', 'service.create', 'service.edit',
            'contact.view', 'dashboard.view',
        ])->get();
        $advisorRole->permissions()->attach($advisorPermissions);

        // Team Member permissions
        $teamMemberPermissions = Permission::whereIn('slug', [
            'research.view', 'research.create',
            'blog.view', 'blog.create',
            'news.view', 'news.create',
            'event.view', 'event.create',
            'project.view', 'project.create',
            'gallery.view', 'gallery.create',
            'service.view', 'service.create',
            'contact.view', 'dashboard.view',
        ])->get();
        $teamMemberRole->permissions()->attach($teamMemberPermissions);
    }
}
