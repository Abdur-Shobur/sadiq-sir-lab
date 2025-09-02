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
            'title'       => 'Innovating the Future Through Technology',
            'subtitle'    => 'Leading Research in Computer Science & Engineering',
            'image'       => 'abouts/about-img1.png',
            'description' => 'Our advanced research lab, under the guidance of expert faculty, is committed to driving innovation in computing. We focus on cutting-edge technologies and real-world applications in areas such as artificial intelligence, cybersecurity, data science, and smart systems. Our mission is to empower students and researchers to build the technology of tomorrow.',
            'features'    => [
                'Artificial Intelligence',
                'Cybersecurity & Privacy',
                'Data Science & Analytics',
                'Internet of Things (IoT)',
                'Machine Learning Models',
                'Cloud Computing',
                'Robotics & Automation',
                'High Performance Computing',
            ],
            'is_active'   => true,
        ]);

    }
}
