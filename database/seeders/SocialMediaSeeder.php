<?php
namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socialMedia = [
            [
                'platform'  => 'facebook',
                'url'       => 'https://www.facebook.com/yourlab',
                'is_active' => true,
            ],
            [
                'platform'  => 'twitter',
                'url'       => 'https://twitter.com/yourlab',
                'is_active' => true,
            ],
            [
                'platform'  => 'instagram',
                'url'       => 'https://www.instagram.com/yourlab',
                'is_active' => true,
            ],
            [
                'platform'  => 'linkedin',
                'url'       => 'https://www.linkedin.com/company/yourlab',
                'is_active' => true,
            ],
            [
                'platform'  => 'youtube',
                'url'       => 'https://www.youtube.com/yourlab',
                'is_active' => true,
            ],
        ];

        foreach ($socialMedia as $social) {
            SocialMedia::create($social);
        }
    }
}
