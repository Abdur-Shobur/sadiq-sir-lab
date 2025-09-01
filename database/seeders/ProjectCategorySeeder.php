<?php

namespace Database\Seeders;

use App\Models\ProjectCategory;
use Illuminate\Database\Seeder;

class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectCategory::create([
            'name' => 'Laboratory Research',
            'is_active' => true,
        ]);

        ProjectCategory::create([
            'name' => 'Medical Technology',
            'is_active' => true,
        ]);

        ProjectCategory::create([
            'name' => 'Environmental Analysis',
            'is_active' => true,
        ]);

        ProjectCategory::create([
            'name' => 'Chemical Analysis',
            'is_active' => true,
        ]);

        ProjectCategory::create([
            'name' => 'Biotechnology',
            'is_active' => true,
        ]);
    }
}
