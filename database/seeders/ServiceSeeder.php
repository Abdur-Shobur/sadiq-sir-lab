<?php
namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title'            => 'Advanced Robotics',
                'description'      => 'Cutting-edge robotic systems for laboratory automation, precision testing, and research applications. Our advanced robotics solutions enhance efficiency and accuracy in scientific processes.',
                'icon'             => 'fas fa-robot',
                'background_color' => '#007bff',
                'order'            => 1,
                'is_active'        => true,
            ],
            [
                'title'            => 'Diabetes Testing',
                'description'      => 'Comprehensive diabetes screening and monitoring services using state-of-the-art equipment. We provide accurate blood glucose testing and comprehensive diabetes management solutions.',
                'icon'             => 'fas fa-heartbeat',
                'background_color' => '#28a745',
                'order'            => 2,
                'is_active'        => true,
            ],
            [
                'title'            => 'Pathology Testing',
                'description'      => 'Advanced pathological analysis and diagnostic services for accurate disease detection. Our expert pathologists use cutting-edge technology for precise tissue and cell analysis.',
                'icon'             => 'fas fa-microscope',
                'background_color' => '#ffc107',
                'order'            => 3,
                'is_active'        => true,
            ],
            [
                'title'            => 'Healthcare Lab',
                'description'      => 'Comprehensive healthcare laboratory services for medical diagnostics and research. We provide a wide range of clinical tests with rapid turnaround times and accurate results.',
                'icon'             => 'fas fa-flask',
                'background_color' => '#fd7e14',
                'order'            => 4,
                'is_active'        => true,
            ],
            [
                'title'            => 'Alternative Energy',
                'description'      => 'Research and development in sustainable energy solutions and environmental technologies. We focus on renewable energy sources and eco-friendly laboratory practices.',
                'icon'             => 'fas fa-leaf',
                'background_color' => '#20c997',
                'order'            => 5,
                'is_active'        => true,
            ],
            [
                'title'            => 'Artificial Intelligence',
                'description'      => 'AI-powered laboratory automation and data analysis for enhanced research capabilities. Our intelligent systems optimize processes and provide predictive analytics.',
                'icon'             => 'fas fa-brain',
                'background_color' => '#6f42c1',
                'order'            => 6,
                'is_active'        => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
