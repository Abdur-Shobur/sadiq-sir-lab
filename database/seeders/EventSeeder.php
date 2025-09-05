<?php
namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title'       => 'Seminar on Big Data Analytics',
                'description' => 'Harnessing Data for Smarter Decisions',
                'image'       => 'events/n3TwGlE6pFvCAN2aRCqjzeYEmmZRHxuXgjl9Wkr6.jpg',
                'event_date'  => Carbon::now()->addDays(15),
                'event_time'  => Carbon::now()->addDays(15)->setTime(10, 0),
                'time'        => '10:00 AM',
                'location'    => 'Main Conference Hall, University Campus',
                'is_active'   => true,
                'order'       => 1,
                'status'      => 'upcoming',
            ],
            [
                'title'       => 'Workshop on Cybersecurity Trends',
                'description' => 'Protecting Data and Privacy in the Digital Age',
                'image'       => 'events/Q1YmqDoQaiyAznE3Oxm4d5HredFErix4moF392wJ.jpg',
                'event_date'  => Carbon::now()->addDays(25),
                'event_time'  => Carbon::now()->addDays(25)->setTime(14, 30),
                'time'        => '2:30 PM',
                'location'    => 'Computer Science Department, Room 205',
                'is_active'   => true,
                'order'       => 2,
                'status'      => 'upcoming',
            ],
            [
                'title'       => 'International Conference on Artificial Intelligence',
                'description' => 'Exploring the Future of Intelligent Systems and Machine Learning',
                'image'       => 'events/tHbXzEgDoZlDEnmSHiFdew3HAdecOXTOYh3YwvNk.jpg',
                'event_date'  => Carbon::now()->addDays(45),
                'event_time'  => Carbon::now()->addDays(45)->setTime(9, 0),
                'time'        => '9:00 AM',
                'location'    => 'Grand Convention Center, Downtown',
                'is_active'   => true,
                'order'       => 3,
                'status'      => 'upcoming',
            ],
            [
                'title'       => 'Tech Innovation Summit 2024',
                'description' => 'Showcasing Latest Technological Breakthroughs and Innovations',
                'image'       => 'events/FwA8TD7TN8ypsRuRrEYBIFjzknwUJPDYpPcKmhsv.jpg',
                'event_date'  => Carbon::now()->addDays(60),
                'event_time'  => Carbon::now()->addDays(60)->setTime(8, 30),
                'time'        => '8:30 AM',
                'location'    => 'Innovation Hub, Tech Park',
                'is_active'   => true,
                'order'       => 4,
                'status'      => 'upcoming',
            ],
            [
                'title'       => 'Machine Learning Bootcamp',
                'description' => 'Hands-on Training in Advanced ML Algorithms and Applications',
                'image'       => 'events/i5k1YXXrdgLjwmjKqnbOzfRYLfnYoissDzJqFhwH.jpg',
                'event_date'  => Carbon::now()->addDays(30),
                'event_time'  => Carbon::now()->addDays(30)->setTime(9, 30),
                'time'        => '9:30 AM',
                'location'    => 'AI Lab, Engineering Building',
                'is_active'   => true,
                'order'       => 5,
                'status'      => 'upcoming',
            ],

        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
