<?php
namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name'          => 'Prof. Sadiq Laboratory',
            'site_description'   => 'Leading research laboratory and scientific services',
            'footer_copyright'   => '© 2025 Sadiq Laboratory. All rights reserved.',
            'footer_description' => 'Leading research laboratory providing cutting-edge scientific solutions and research services.',
            'contact_email'      => 'info@sadiq-laboratory.com',
            'contact_phone'      => '+1 (555) 123-4567',
            'contact_website'    => 'https://sadiq-laboratory.com',
            'contact_address'    => '123 Research Drive, Science City, SC 12345',
        ];

        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value, 'text', 'general');
        }
    }
}
