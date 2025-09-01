<?php
namespace Database\Seeders;

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
        Team::create([
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

        // Create regular team member
        Team::create([
            'name'         => 'John Doe',
            'email'        => 'john@example.com',
            'password'     => Hash::make('password'),
            'designation'  => 'Senior Developer',
            'role'         => 'team',
            'phone'        => '+1234567891',
            'website'      => 'https://johndoe.dev',
            'address'      => '456 Developer Avenue, City, Country',
            'specialities' => ['Laravel Development', 'Vue.js', 'API Development'],
            'education'    => ['Bachelor of Computer Science', 'Web Development Certification'],
            'experience'   => ['4+ years in Laravel Development', '2+ years in Frontend Development'],
            'social_media' => [
                ['platform' => 'GitHub', 'url' => 'https://github.com/johndoe'],
                ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/in/johndoe'],
            ],
            'is_active'    => true,
        ]);

        // Create another team member
        Team::create([
            'name'         => 'Jane Smith',
            'email'        => 'jane@example.com',
            'password'     => Hash::make('password'),
            'designation'  => 'UI/UX Designer',
            'role'         => 'team',
            'phone'        => '+1234567892',
            'website'      => 'https://janesmith.design',
            'address'      => '789 Design Street, City, Country',
            'specialities' => ['User Interface Design', 'User Experience', 'Prototyping'],
            'education'    => ['Bachelor of Design', 'UX Design Certification'],
            'experience'   => ['3+ years in UI/UX Design', '2+ years in Prototyping'],
            'social_media' => [
                ['platform' => 'Behance', 'url' => 'https://behance.net/janesmith'],
                ['platform' => 'Dribbble', 'url' => 'https://dribbble.com/janesmith'],
            ],
            'is_active'    => true,
        ]);
    }
}
