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
            'title'              => 'Science is Nothing But Perception',
            'subtitle'           => 'Laboratory & Science',
            'description'        => 'Welcome to our state-of-the-art laboratory where innovation meets precision. We conduct cutting-edge research and provide exceptional analytical services to advance scientific discovery.',
            'action_button_text' => 'Make Appointment',
            'action_button_link' => '/contact',
            'banner_image'       => null, // Set to null initially, will be updated when user uploads image
            'is_active'          => true,
        ]);
    }
}
