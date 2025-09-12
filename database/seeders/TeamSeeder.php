<?php
namespace Database\Seeders;

use App\Models\Role;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin team member
        $admin = Team::create([
            'name'         => 'Admin User',
            'email'        => 'admin@example.com',
            'password'     => Hash::make('password'),
            'designation'  => 'System Administrator',
            'role'         => 'admin',
            'phone'        => '+1234567890',
            'website'      => 'https://example.com',
            'address'      => '123 Admin Street, City, Country',
            'specialities' => ['System Administration', 'Project Management', 'Team Leadership'],
            'education'    => ['Master of Computer Science', 'Bachelor of Information Technology'],
            'experience'   => ['5+ years in System Administration', '3+ years in Project Management'],
            'social_media' => [
                ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/in/admin'],
                ['platform' => 'Twitter', 'url' => 'https://twitter.com/admin'],
            ],
            'is_active'    => true,
        ]);

        // Assign admin role
        $adminRole = Role::where('slug', 'admin')->first();
        if ($adminRole) {
            $admin->assignRole($adminRole);
        }

        // Create advisor team member
        $advisor = Team::create([
            'name'         => 'Dr. Sarah Johnson',
            'email'        => 'sarah@example.com',
            'password'     => Hash::make('password'),
            'designation'  => 'Research Advisor',
            'role'         => 'advisor',
            'phone'        => '+1234567891',
            'website'      => 'https://sarahjohnson.research',
            'address'      => '456 Research Avenue, City, Country',
            'specialities' => ['Research Methodology', 'Data Analysis', 'Academic Writing'],
            'education'    => ['PhD in Computer Science', 'Master of Research Methods'],
            'experience'   => ['8+ years in Research', '5+ years in Academic Supervision'],
            'social_media' => [
                ['platform' => 'ResearchGate', 'url' => 'https://researchgate.net/sarahjohnson'],
                ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/in/sarahjohnson'],
            ],
            'is_active'    => true,
        ]);

        // Assign advisor role
        $advisorRole = Role::where('slug', 'advisor')->first();
        if ($advisorRole) {
            $advisor->assignRole($advisorRole);
        }

        // Create regular team member
        $teamMember = Team::create([
            'name'         => 'John Doe',
            'email'        => 'john@example.com',
            'password'     => Hash::make('password'),
            'designation'  => 'Senior Developer',
            'role'         => 'team_member',
            'phone'        => '+1234567892',
            'website'      => 'https://johndoe.dev',
            'address'      => '789 Developer Street, City, Country',
            'specialities' => ['Laravel Development', 'Vue.js', 'API Development'],
            'education'    => ['Bachelor of Computer Science', 'Web Development Certification'],
            'experience'   => ['4+ years in Laravel Development', '2+ years in Frontend Development'],
            'social_media' => [
                ['platform' => 'GitHub', 'url' => 'https://github.com/johndoe'],
                ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/in/johndoe'],
            ],
            'is_active'    => true,
        ]);

        // Assign team member role
        $teamMemberRole = Role::where('slug', 'team_member')->first();
        if ($teamMemberRole) {
            $teamMember->assignRole($teamMemberRole);
        }

        // Create another team member
        $teamMember2 = Team::create([
            'name'         => 'Jane Smith',
            'email'        => 'jane@example.com',
            'password'     => Hash::make('password'),
            'designation'  => 'UI/UX Designer',
            'role'         => 'team_member',
            'phone'        => '+1234567893',
            'website'      => 'https://janesmith.design',
            'address'      => '321 Design Street, City, Country',
            'specialities' => ['User Interface Design', 'User Experience', 'Prototyping'],
            'education'    => ['Bachelor of Design', 'UX Design Certification'],
            'experience'   => ['3+ years in UI/UX Design', '2+ years in Prototyping'],
            'social_media' => [
                ['platform' => 'Behance', 'url' => 'https://behance.net/janesmith'],
                ['platform' => 'Dribbble', 'url' => 'https://dribbble.com/janesmith'],
            ],
            'is_active'    => true,
        ]);

        // Assign team member role
        if ($teamMemberRole) {
            $teamMember2->assignRole($teamMemberRole);
        }
    }
}
