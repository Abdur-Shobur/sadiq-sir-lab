<?php
namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsArticles = [
            [
                'title'       => 'Breakthrough in Antibody Half-Life Research',
                'description' => 'Our latest research reveals new insights into improving antibody half-life measurements, potentially revolutionizing therapeutic treatments.',
                'content'     => '<p>Scientists at our laboratory have made significant strides in understanding antibody half-life dynamics. This breakthrough research could lead to more effective therapeutic treatments and improved patient outcomes.</p>

                <h3>Key Findings</h3>
                <ul>
                    <li>Novel measurement techniques increase accuracy by 40%</li>
                    <li>Improved stability markers identified</li>
                    <li>Enhanced therapeutic potential demonstrated</li>
                </ul>

                <p>The research team, led by Dr. Sarah Johnson, utilized advanced spectroscopic methods to analyze antibody degradation patterns. Their findings suggest that current therapeutic dosing schedules could be optimized based on these new measurements.</p>

                <h3>Clinical Implications</h3>
                <p>These discoveries have immediate implications for clinical practice, potentially allowing for:</p>
                <ul>
                    <li>Reduced treatment frequency</li>
                    <li>Lower patient burden</li>
                    <li>Cost-effective therapy options</li>
                </ul>',
                'status'      => true,
                'created_at'  => now()->subDays(7),
                'updated_at'  => now()->subDays(7),
            ],
            [
                'title'       => 'New Mouse Model for Rare Disease Research',
                'description' => 'Development of an innovative mouse model opens new avenues for studying rare genetic diseases and potential therapeutic interventions.',
                'content'     => '<p>Our research team has successfully developed a versatile mouse model that mimics rare genetic diseases, providing researchers worldwide with a powerful tool for drug discovery and therapeutic development.</p>

                <h3>Model Characteristics</h3>
                <p>The new mouse model exhibits:</p>
                <ul>
                    <li>High genetic similarity to human conditions</li>
                    <li>Reproducible disease progression</li>
                    <li>Enhanced therapeutic screening capabilities</li>
                </ul>

                <p>Dr. Michael Chen, the lead researcher, explained: "This model represents a significant advancement in rare disease research. It provides a more accurate representation of human pathology than previous models."</p>

                <h3>Research Applications</h3>
                <p>The model is already being used to investigate:</p>
                <ul>
                    <li>Gene therapy approaches</li>
                    <li>Small molecule interventions</li>
                    <li>Disease mechanism studies</li>
                </ul>

                <p>We expect this tool to accelerate research timelines and improve the translation of laboratory findings to clinical applications.</p>',
                'status'      => true,
                'created_at'  => now()->subDays(14),
                'updated_at'  => now()->subDays(14),
            ],
            [
                'title'       => 'Laboratory Safety Protocol Updates',
                'description' => 'New safety protocols implemented across all laboratory facilities to ensure the highest standards of researcher and environmental protection.',
                'content'     => '<p>In our ongoing commitment to safety excellence, we have implemented comprehensive updates to our laboratory safety protocols. These changes reflect the latest industry standards and regulatory requirements.</p>

                <h3>Key Protocol Updates</h3>
                <ul>
                    <li>Enhanced chemical handling procedures</li>
                    <li>Updated emergency response protocols</li>
                    <li>Improved personal protective equipment standards</li>
                    <li>Advanced waste management systems</li>
                </ul>

                <p>All laboratory personnel have completed mandatory training sessions on the new protocols. The safety team, led by Dr. Emily Rodriguez, conducted comprehensive workshops covering theoretical knowledge and practical applications.</p>

                <h3>Training and Compliance</h3>
                <p>The implementation includes:</p>
                <ul>
                    <li>Monthly safety audits</li>
                    <li>Quarterly training refreshers</li>
                    <li>Real-time monitoring systems</li>
                    <li>Incident reporting improvements</li>
                </ul>

                <p>These measures ensure that our laboratory maintains its reputation as a leader in safety excellence while supporting cutting-edge research activities.</p>',
                'status'      => true,
                'created_at'  => now()->subDays(21),
                'updated_at'  => now()->subDays(21),
            ],
            [
                'title'       => 'International Research Collaboration Announced',
                'description' => 'Exciting new partnership with leading international institutions will expand our research capabilities and global impact.',
                'content'     => '<p>We are thrilled to announce a groundbreaking international collaboration with research institutions across three continents. This partnership will significantly enhance our research capabilities and global scientific impact.</p>

                <h3>Partner Institutions</h3>
                <ul>
                    <li>European Molecular Biology Laboratory (EMBL)</li>
                    <li>Riken Institute, Japan</li>
                    <li>National Institutes of Health (NIH), USA</li>
                    <li>Max Planck Institute, Germany</li>
                </ul>

                <p>The collaboration focuses on advancing our understanding of molecular mechanisms in disease progression and developing innovative therapeutic approaches.</p>

                <h3>Research Focus Areas</h3>
                <p>Joint research efforts will concentrate on:</p>
                <ul>
                    <li>Precision medicine development</li>
                    <li>Advanced imaging techniques</li>
                    <li>Computational biology applications</li>
                    <li>Drug delivery systems</li>
                </ul>

                <p>Dr. James Wilson, our Director of International Relations, stated: "This collaboration represents a new chapter in our research journey. By combining expertise from leading institutions worldwide, we can tackle complex scientific challenges more effectively."</p>

                <h3>Expected Outcomes</h3>
                <p>The partnership is expected to produce:</p>
                <ul>
                    <li>Joint publications in top-tier journals</li>
                    <li>Shared research infrastructure</li>
                    <li>Student and researcher exchange programs</li>
                    <li>Accelerated translation of research findings</li>
                </ul>',
                'status'      => true,
                'created_at'  => now()->subDays(30),
                'updated_at'  => now()->subDays(30),
            ],
            [
                'title'       => 'Grant Funding Success for Cancer Research',
                'description' => 'Significant funding secured for innovative cancer research project focused on early detection and personalized treatment approaches.',
                'content'     => '<p>We are pleased to announce that our cancer research team has secured substantial funding from the National Cancer Institute for a pioneering project focused on early detection and personalized treatment strategies.</p>

                <h3>Project Overview</h3>
                <p>The five-year project, valued at $2.5 million, will investigate:</p>
                <ul>
                    <li>Novel biomarker discovery</li>
                    <li>Advanced diagnostic techniques</li>
                    <li>Personalized therapy development</li>
                    <li>Treatment response prediction</li>
                </ul>

                <p>Principal Investigator Dr. Lisa Thompson expressed her excitement: "This funding allows us to pursue innovative approaches that could revolutionize cancer care. Our focus on personalized medicine has the potential to significantly improve patient outcomes."</p>

                <h3>Research Team</h3>
                <p>The project brings together experts from multiple disciplines:</p>
                <ul>
                    <li>Molecular biologists</li>
                    <li>Computational scientists</li>
                    <li>Clinical researchers</li>
                    <li>Biostatisticians</li>
                </ul>

                <h3>Timeline and Milestones</h3>
                <p>Key project milestones include:</p>
                <ul>
                    <li>Year 1: Biomarker identification and validation</li>
                    <li>Year 2-3: Diagnostic platform development</li>
                    <li>Year 4-5: Clinical validation and implementation</li>
                </ul>

                <p>The research is expected to generate significant intellectual property and potentially lead to spin-off companies focused on commercializing the developed technologies.</p>',
                'status'      => true,
                'created_at'  => now()->subDays(45),
                'updated_at'  => now()->subDays(45),
            ],
        ];

        foreach ($newsArticles as $article) {
            News::create($article);
        }
    }
}
