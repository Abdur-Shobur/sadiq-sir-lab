<?php
namespace Database\Seeders;

use App\Models\TeamCategory;
use Illuminate\Database\Seeder;

class TeamCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'title'       => 'Faculty',
                'description' => 'Faculty members and professors',
                'sort_order'  => 1,
                'is_active'   => true,
            ],
            [
                'title'       => 'Research Staff',
                'description' => 'Research scientists and research associates',
                'sort_order'  => 2,
                'is_active'   => true,
            ],
            [
                'title'       => 'Graduate Students',
                'description' => 'PhD and Masters students',
                'sort_order'  => 3,
                'is_active'   => true,
            ],
            [
                'title'       => 'Undergraduate Students',
                'description' => 'Undergraduate research assistants',
                'sort_order'  => 4,
                'is_active'   => true,
            ],
            [
                'title'       => 'Administrative Staff',
                'description' => 'Administrative and support staff',
                'sort_order'  => 5,
                'is_active'   => true,
            ],
        ];

        foreach ($categories as $category) {
            TeamCategory::create($category);
        }
    }
}
