<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Technology',
            'Science',
            'Health & Medicine',
            'Research',
            'Education',
            'Innovation',
            'Industry News',
            'Case Studies',
        ];

        foreach ($categories as $category) {
            BlogCategory::create([
                'name' => $category,
                'status' => true,
            ]);
        }
    }
}
