<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ProjectCategory::all();

        if ($categories->count() > 0) {
            Project::create([
                'title' => 'Nuclear Micro-reactors Research',
                'subtitle' => 'Advanced nuclear technology for sustainable energy solutions',
                'content' => '<h2>Project Overview</h2><p>This research project focuses on developing advanced nuclear micro-reactors for sustainable energy solutions.</p><h3>Research Objectives</h3><ul><li>Design and develop compact nuclear reactors</li><li>Improve safety and efficiency standards</li><li>Reduce environmental impact</li></ul><h3>Expected Outcomes</h3><p>This project aims to revolutionize the nuclear energy sector with safer, more efficient micro-reactor technology.</p>',
                'project_category_id' => $categories->first()->id,
                'is_active' => true,
            ]);

            Project::create([
                'title' => 'Metabolism Regulation Study',
                'subtitle' => 'Understanding cellular metabolism for medical applications',
                'content' => '<h2>Project Overview</h2><p>This study investigates cellular metabolism regulation for potential medical applications.</p><h3>Research Focus</h3><ul><li>Cellular metabolism pathways</li><li>Regulatory mechanisms</li><li>Medical applications</li></ul><h3>Impact</h3><p>This research could lead to new treatments for metabolic disorders.</p>',
                'project_category_id' => $categories->skip(1)->first()->id,
                'is_active' => true,
            ]);

            Project::create([
                'title' => 'Translational Research Initiative',
                'subtitle' => 'Bridging laboratory discoveries to clinical applications',
                'content' => '<h2>Project Overview</h2><p>This initiative focuses on translating laboratory discoveries into clinical applications.</p><h3>Goals</h3><ul><li>Bridge research and clinical practice</li><li>Accelerate drug development</li><li>Improve patient outcomes</li></ul><h3>Methodology</h3><p>Using advanced laboratory techniques to validate clinical hypotheses.</p>',
                'project_category_id' => $categories->skip(2)->first()->id,
                'is_active' => true,
            ]);
        }
    }
}
