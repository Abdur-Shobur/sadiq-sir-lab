<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use Illuminate\Database\Seeder;

class GalleryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Research Projects',
                'slug' => 'research-projects',
                'description' => 'Gallery showcasing our research projects and findings',
                'is_active' => true,
            ],
            [
                'name' => 'Laboratory Equipment',
                'slug' => 'laboratory-equipment',
                'description' => 'Images of our state-of-the-art laboratory equipment',
                'is_active' => true,
            ],
            [
                'name' => 'Team Activities',
                'slug' => 'team-activities',
                'description' => 'Photos from team meetings, conferences, and events',
                'is_active' => true,
            ],
            [
                'name' => 'Publications',
                'slug' => 'publications',
                'description' => 'Cover images and highlights from our publications',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            GalleryCategory::create($category);
        }
    }
}
