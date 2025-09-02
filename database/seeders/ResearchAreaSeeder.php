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
                'title'            => 'Artificial Intelligence',
                'description'      => 'Building intelligent systems that learn, adapt, and make decisions like humans.',
                'background_color' => 'bg-43c784',
                'order'            => 1,
                'is_active'        => true,
                'image'            => 'research-areas/1.png',
            ],
            [
                'title'            => 'Cybersecurity & Privacy',
                'description'      => 'Protecting digital systems through secure architectures and threat detection.',
                'background_color' => 'bg-fe5d24',
                'order'            => 2,
                'is_active'        => true,
                'image'            => 'research-areas/2.png',
            ],
            [
                'title'            => 'Data Science & Analytics',
                'description'      => 'Extracting meaningful insights from complex datasets to drive smart decisions.',
                'background_color' => 'bg-f59f00',
                'order'            => 3,
                'is_active'        => true,
                'image'            => 'research-areas/3.png',
            ],
            [
                'title'            => 'Internet of Things (IoT)',
                'description'      => 'Connecting devices and systems to build smart, responsive environments.',
                'background_color' => 'bg-43c784',
                'order'            => 4,
                'is_active'        => true,
                'image'            => 'research-areas/4.png',
            ],
            [
                'title'            => 'High Performance Computing (HPC)',
                'description'      => 'Solving large-scale problems with advanced computing power and parallel processing.',
                'background_color' => 'bg-fe5d24',
                'order'            => 5,
                'is_active'        => true,
                'image'            => 'research-areas/5.png',
            ],
        ];

        foreach ($researchAreas as $researchArea) {
            ResearchArea::create($researchArea);
        }
    }
}
