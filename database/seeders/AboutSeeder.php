<?php
namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'title'       => 'We Discoveries We Give Your Solution',
            'subtitle'    => 'Leading Laboratory Research & Innovation',
            'description' => 'Our state-of-the-art laboratory facility is dedicated to advancing scientific research and providing cutting-edge solutions for healthcare, environmental science, and industrial applications. With decades of experience and a team of expert researchers, we deliver accurate, reliable results that drive innovation and progress.',
            'features'    => [
                'Chemical Research',
                'Pathology Testing',
                'Sample Preparation',
                'Healthcare Labs',
                'Advanced Microscopy',
                'Advanced Robotics',
                'Environmental Testing',
                'Anatomical Pathology',
            ],
            'is_active'   => true,
        ]);
    }
}
