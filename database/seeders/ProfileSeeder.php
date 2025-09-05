<?php
namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = [
            [
                'email'   => 'info@sadiqlab.com',
                'phone'   => '+880 1234 567890',
                'address' => 'Department of Computer Science & Engineering, Bangladesh University, Dhaka, Bangladesh',
                'logo'    => null,
                'image'   => null,
            ],
        ];

        foreach ($profiles as $profile) {
            Profile::create($profile);
        }
    }
}
