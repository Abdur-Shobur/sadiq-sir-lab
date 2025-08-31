<?php
namespace Database\Seeders;

use App\Models\ResearchArea;
use Illuminate\Database\Seeder;

class ResearchAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $researchAreas = [
            [
                'title'            => 'Biotechnology Research',
                'description'      => 'Advanced research in genetic engineering, molecular biology, and bioprocessing technologies. Developing innovative solutions for healthcare, agriculture, and environmental sustainability.',
                'background_color' => 'bg-default',
                'order'            => 1,
                'is_active'        => true,
            ],
            [
                'title'            => 'Analytical Chemistry',
                'description'      => 'Cutting-edge analytical techniques and instrumentation for chemical analysis, quality control, and research applications in pharmaceuticals and materials science.',
                'background_color' => 'bg-43c784',
                'order'            => 2,
                'is_active'        => true,
            ],
            [
                'title'            => 'Environmental Science',
                'description'      => 'Research focused on environmental monitoring, pollution control, and sustainable development practices for a cleaner and healthier environment.',
                'background_color' => 'bg-f59f00',
                'order'            => 3,
                'is_active'        => true,
            ],
        ];

        foreach ($researchAreas as $researchArea) {
            ResearchArea::create($researchArea);
        }
    }
}
