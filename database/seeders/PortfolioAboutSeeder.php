<?php
namespace Database\Seeders;

use App\Models\PortfolioAbout;
use Illuminate\Database\Seeder;

class PortfolioAboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $portfolioAbouts = [
            [
                'title'       => 'About Me',
                'subtitle'    => 'Chairman, Educator & Innovator in Computer Science & Engineering',
                'description' => 'Professor Md Sadiq Iqbal is a passionate academic and visionary leader dedicated to advancing computer science education, research, and innovation. As Chairman of the Department of Computer Science & Engineering at Bangladesh University, he strives to empower students and researchers with cutting-edge knowledge and practical skills that drive technological advancement.',
                'image1'      => 'portfolio-abouts/1.jpg',
                'image2'      => 'portfolio-abouts/2.jpg',
                'is_active'   => true,
            ],

        ];

        foreach ($portfolioAbouts as $about) {
            PortfolioAbout::create($about);
        }
    }
}
