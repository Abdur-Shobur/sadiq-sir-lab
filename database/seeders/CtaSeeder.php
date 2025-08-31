<?php

namespace Database\Seeders;

use App\Models\Cta;
use Illuminate\Database\Seeder;

class CtaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cta::create([
            'title'        => "We'll ensure you always get the best Results",
            'subtitle'     => 'Leading Laboratory Research & Innovation',
            'description'  => 'Our state-of-the-art laboratory facility is dedicated to advancing scientific research and providing cutting-edge solutions for healthcare, environmental science, and industrial applications. With decades of experience and a team of expert researchers, we deliver accurate, reliable results that drive innovation and progress.',
            'phone_number' => '+0112343874444',
            'button_text'  => 'Contact Us',
            'is_active'    => true,
        ]);
    }
}
