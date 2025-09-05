<?php
namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $achievements = [
            [
                'image'       => null,
                'period'      => '2014 - Present',
                'title'       => 'Associate Professor and Head',
                'description' => 'Department of Computer Science & Engineering, Bangladesh University, Dhaka, Bangladesh (BU)',
                'link'        => null,
                'is_active'   => true,
            ],
            [
                'image'       => null,
                'period'      => '08/2008 – 07/2014',
                'title'       => 'Assistant Professor and Head',
                'description' => 'Department of Computer Science & Engineering, Bangladesh University, Dhaka, Bangladesh (BU)',
                'link'        => null,
                'is_active'   => true,
            ],
            [
                'image'       => null,
                'period'      => '08/2009 - Present',
                'title'       => 'CEO',
                'description' => 'Center For Excellence in Research, Entrepreneurship & Teaching (CERET), Bangladesh University, Dhaka, Bangladesh',
                'link'        => 'http://localhost:3000/admin/achievement',
                'is_active'   => true,
            ],
            [
                'image'       => null,
                'period'      => '05/2005 - 07/2008',
                'title'       => 'Lecturer',
                'description' => 'Department of Computer Science and Engineering, Bangladesh University, Dhaka, Bangladesh',
                'link'        => 'http://localhost:3000/admin/research',
                'is_active'   => true,
            ],
            [
                'image'       => null,
                'period'      => '09/1999 - 02/2001',
                'title'       => 'Teaching assistant',
                'description' => 'National Technical University of Ukraine, Kiev, Ukraine',
                'link'        => '',
                'is_active'   => true,
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }
    }
}
