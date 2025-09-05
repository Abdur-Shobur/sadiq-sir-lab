<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create admin user for dashboard
        $this->call([
            UserSeeder::class,
            BannerSeeder::class,
            AboutSeeder::class,
            ServiceSeeder::class,
            CtaSeeder::class,
            ProjectCategorySeeder::class,
            ProjectSeeder::class,
            PublicationSeeder::class,
            EventSeeder::class,
            TeamSeeder::class,
            ResearchAreaSeeder::class,
            BlogCategorySeeder::class,
            BlogSeeder::class,
            NewsSeeder::class,
            SettingsSeeder::class,
            SocialMediaSeeder::class,
            PortfolioBannerSeeder::class,
            PortfolioAboutSeeder::class,
            ResearchSeeder::class,
            AchievementSeeder::class,
            GalleryCategorySeeder::class,
            GallerySeeder::class,
        ]);
    }
}
