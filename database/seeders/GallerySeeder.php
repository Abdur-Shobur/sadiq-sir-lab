<?php
namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run()
    {
        $galleries = [
            // Celebrations category (ID: 1)
            [
                'gallery_category_id' => 1,
                'title'               => 'Events',
                'description'         => 'Events',
                'image'               => 'galleries/ESrSfKDEFypsn0hACMEe2rNJFb7a2r2hKRs0D55O.jpg',
                'link'                => null,
                'is_active'           => true,
                'order'               => 0,
            ],
            [
                'gallery_category_id' => 1,
                'title'               => 'Lectures',
                'description'         => 'Celebrations',
                'image'               => 'galleries/yWEhP7vGbOQ5t6DwSMqakNCz3uXJBlYgTSwUZObN.jpg',
                'link'                => null,
                'is_active'           => true,
                'order'               => 2,
            ],
            [
                'gallery_category_id' => 1,
                'title'               => 'Tournament',
                'description'         => 'Events',
                'image'               => 'galleries/6Jobx59CwFhhzKmimJ0Kb9vo5AzbBgjLxJXTvttK.jpg',
                'link'                => null,
                'is_active'           => true,
                'order'               => 3,
            ],

            // Events category (ID: 2)
            [
                'gallery_category_id' => 2,
                'title'               => 'Programs',
                'description'         => 'Celebrations',
                'image'               => 'galleries/GUWnBi6PKBFzOERlrtNvPAM0JlVbUGRhyJM6VgvF.jpg',
                'link'                => null,
                'is_active'           => true,
                'order'               => 4,
            ],
            [
                'gallery_category_id' => 2,
                'title'               => 'Workshops',
                'description'         => 'Celebrations',
                'image'               => 'galleries/6GfjnPMEwEbst9Lw8U4C51tsYDORMIxtuJsLnYdC.jpg',
                'link'                => null,
                'is_active'           => true,
                'order'               => 5,
            ],
            [
                'gallery_category_id' => 2,
                'title'               => 'Programs',
                'description'         => 'Meetings',
                'image'               => 'galleries/gn81tVxWBzNdTo0zE9bLWLQWi1heW2ZSGxdR6Nnz.jpg',
                'link'                => null,
                'is_active'           => true,
                'order'               => 6,
            ],
            [
                'gallery_category_id' => 2,
                'title'               => 'Achievements',
                'description'         => 'Celebrations',
                'image'               => 'galleries/VMpznLJrvVYLTtDBeMU4XqWnLIVZR1d2LPxWs5Pj.jpg',
                'link'                => null,
                'is_active'           => true,
                'order'               => 7,
            ],

            // Lectures category (ID: 3)
            [
                'gallery_category_id' => 3,
                'title'               => 'Celebrations',
                'description'         => 'Celebrations',
                'image'               => 'galleries/ZQFJwAX1AbydeqdU0rXz1XC6rDFvfMJXinYhUzFN.jpg',
                'link'                => null,
                'is_active'           => true,
                'order'               => 8,
            ],
            [
                'gallery_category_id' => 3,
                'title'               => 'Seminars',
                'description'         => 'Celebrations',
                'image'               => 'galleries/KJQTXUFmkkDxnVtjgEwk1QtGzo7ZA1KXkJ7f3q3G.jpg',
                'link'                => null,
                'is_active'           => true,
                'order'               => 9,
            ],

        ];

        foreach ($galleries as $gallery) {
            Gallery::updateOrCreate(
                [
                    'gallery_category_id' => $gallery['gallery_category_id'],
                    'title'               => $gallery['title'],
                ],
                $gallery
            );
        }
    }
}
