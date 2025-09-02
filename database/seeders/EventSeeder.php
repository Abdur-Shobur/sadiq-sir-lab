<?php
namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'title'     => 'Advanced Robotics Workshop',
            'subtitle'  => 'Learn the latest in robotics technology',
            'content'   => '<h2>Workshop Overview</h2><p>Join us for an intensive workshop on advanced robotics technology.</p><h3>What You\'ll Learn</h3><ul><li>Robotics fundamentals</li><li>Programming robots</li><li>AI integration</li></ul><h3>Duration</h3><p>3-day intensive workshop with hands-on projects.</p>',
            'icon'      => 'fas fa-calendar',
            'is_active' => true,
        ]);

        Event::create([
            'title'     => 'Diabetes Testing Seminar',
            'subtitle'  => 'Understanding diabetes and testing methods',
            'content'   => '<h2>Seminar Overview</h2><p>Comprehensive seminar on diabetes testing and management.</p><h3>Topics Covered</h3><ul><li>Diabetes types and symptoms</li><li>Testing methodologies</li><li>Prevention strategies</li></ul><h3>Target Audience</h3><p>Healthcare professionals and researchers.</p>',
            'icon'      => 'fas fa-calendar',
            'is_active' => true,
        ]);

        Event::create([
            'title'     => 'Pathology Testing Conference',
            'subtitle'  => 'Latest developments in pathology testing',
            'content'   => '<h2>Conference Overview</h2><p>International conference on pathology testing advancements.</p><h3>Key Sessions</h3><ul><li>Molecular pathology</li><li>Digital pathology</li><li>Quality assurance</li></ul><h3>Networking</h3><p>Connect with leading experts in the field.</p>',
            'icon'      => 'fas fa-calendar',
            'is_active' => true,
        ]);
    }
}
