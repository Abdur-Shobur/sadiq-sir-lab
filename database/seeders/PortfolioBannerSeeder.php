<?php
namespace Database\Seeders;

use App\Models\PortfolioBanner;
use Illuminate\Database\Seeder;

class PortfolioBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $portfolioBanners = [
            [
                'title'           => 'Prof. Md Sadiq Iqbal Test',
                'subtitle'        => 'Chairman, Department of Computer Science & Engineering',
                'description'     => 'Bangladesh University',
                'additional_text' => 'At the Department of Computer Science & Engineering, under the visionary leadership of Prof. Md Sadiq Iqbal, we are committed to fostering a culture of innovation, critical thinking, and academic excellence. We believe in preparing students not just as engineers, but as future leaders who will shape the technological landscape.',
                'image'           => 'portfolio-banners/1.jpg',
                'is_active'       => true,
                'order'           => 1,
            ],

        ];

        foreach ($portfolioBanners as $banner) {
            PortfolioBanner::create($banner);
        }
    }
}
