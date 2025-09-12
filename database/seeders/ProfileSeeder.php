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
                'email'   => 'sadiq.iqbal@bu.edu.bd',
                'phone'   => '+880 1755559312',
                'address' => 'Bangladesh University, Department of Computer Science & Engineering, Dhaka, Bangladesh',
                'logo'    => 'profiles/logo.webp',
                'image'   => null,
            ],
        ];

        foreach ($profiles as $profile) {
            Profile::create($profile);
        }
    }
}
