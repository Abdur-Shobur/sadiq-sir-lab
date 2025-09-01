<?php
namespace Database\Seeders;

use App\Models\Publication;
use Illuminate\Database\Seeder;

class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Publication::create([
            'content'   => '<h2>Our Research Publications</h2>
<p>Welcome to our publications section where we showcase our latest research and findings in laboratory sciences.</p>

<h3>Recent Research Areas</h3>
<p>Our team has been actively working on several key areas of research:</p>

<ul>
    <li><strong>Advanced Analytical Techniques:</strong> Developing new methodologies for precise laboratory analysis</li>
    <li><strong>Medical Laboratory Technology:</strong> Innovations in patient care and diagnostic accuracy</li>
    <li><strong>Environmental Analysis:</strong> Sustainable approaches to laboratory testing</li>
</ul>

<h3>Research Methodology</h3>
<p>We employ state-of-the-art laboratory equipment and analytical techniques to ensure the highest standards of accuracy and reliability in our research.</p>

<h3>Future Directions</h3>
<p>Our ongoing research focuses on:</p>
<ul>
    <li>Integration of AI and machine learning in laboratory processes</li>
    <li>Development of green laboratory practices</li>
    <li>Enhancement of diagnostic capabilities</li>
</ul>

<p>For more information about our research projects, please contact our team.</p>',
            'is_active' => true,
        ]);
    }
}
