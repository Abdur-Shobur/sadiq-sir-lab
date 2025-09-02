<?php
namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::create([
            'title'              => 'Where Innovation Meets Intelligence',
            'subtitle'           => 'Computer Science & Engineering Lab',
            'description'        => 'Welcome to our advanced research lab led by Prof. Sadiq Iqbal, Head of the CSE Department. We explore next-gen technologies, foster creativity, and drive innovation in computing and engineering.',
            'action_button_text' => 'Make Appointment',
            'action_button_link' => '/contact',
            'banner_image'       => 'banners/banner-img1.png',
            'is_active'          => true,
        ]);
    }
}
