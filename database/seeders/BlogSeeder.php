<?php
namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get blog categories
        $categories = BlogCategory::all();

        if ($categories->isEmpty()) {
            $this->command->info('No blog categories found. Please run BlogCategorySeeder first.');
            return;
        }

        $blogs = [
            [
                'blog_category_id' => $categories->where('name', 'Technology')->first()->id ?? $categories->first()->id,
                'title'            => 'The Future of Artificial Intelligence',
                'subtitle'         => 'Exploring the latest developments in AI and machine learning',
                'content'          => '<h2>The Future of Artificial Intelligence</h2><p>Artificial Intelligence (AI) is rapidly transforming the way we live and work. From virtual assistants to autonomous vehicles, AI technologies are becoming increasingly integrated into our daily lives.</p><p>Recent developments in machine learning algorithms have enabled computers to perform tasks that were once thought to be exclusively human, such as natural language processing, image recognition, and decision-making.</p><h3>Key Trends in AI</h3><ul><li>Deep Learning and Neural Networks</li><li>Natural Language Processing</li><li>Computer Vision</li><li>Robotics and Automation</li></ul><p>As we look to the future, AI will continue to evolve and impact various industries, from healthcare to finance, creating new opportunities and challenges for society.</p>',
                'status'           => true,
            ],
            [
                'blog_category_id' => $categories->where('name', 'Science')->first()->id ?? $categories->first()->id,
                'title'            => 'Breakthrough in Quantum Computing',
                'subtitle'         => 'Scientists achieve quantum supremacy in computational tasks',
                'content'          => '<h2>Breakthrough in Quantum Computing</h2><p>Quantum computing represents a paradigm shift in computational power, leveraging the principles of quantum mechanics to process information in ways that classical computers cannot.</p><p>Recent breakthroughs have demonstrated quantum supremacy, where quantum computers solve problems that would take classical supercomputers thousands of years to complete.</p><h3>Applications of Quantum Computing</h3><ul><li>Cryptography and Security</li><li>Drug Discovery and Molecular Modeling</li><li>Optimization Problems</li><li>Climate Modeling</li></ul><p>This technology has the potential to revolutionize fields such as cryptography, drug discovery, and complex system modeling.</p>',
                'status'           => true,
            ],
            [
                'blog_category_id' => $categories->where('name', 'Health & Medicine')->first()->id ?? $categories->first()->id,
                'title'            => 'Advances in Precision Medicine',
                'subtitle'         => 'Personalized treatment approaches for better patient outcomes',
                'content'          => '<h2>Advances in Precision Medicine</h2><p>Precision medicine is revolutionizing healthcare by tailoring medical treatment to individual characteristics, including genetic makeup, lifestyle, and environment.</p><p>This approach moves away from the traditional "one-size-fits-all" model and towards personalized care that considers each patient\'s unique profile.</p><h3>Key Components of Precision Medicine</h3><ul><li>Genomic Sequencing</li><li>Biomarker Analysis</li><li>Targeted Therapies</li><li>Digital Health Technologies</li></ul><p>Precision medicine holds promise for treating complex diseases like cancer, cardiovascular disorders, and rare genetic conditions with greater effectiveness and fewer side effects.</p>',
                'status'           => true,
            ],
            [
                'blog_category_id' => $categories->where('name', 'Education')->first()->id ?? $categories->first()->id,
                'title'            => 'The Evolution of Online Learning',
                'subtitle'         => 'How digital platforms are reshaping education',
                'content'          => '<h2>The Evolution of Online Learning</h2><p>The landscape of education has been dramatically transformed by digital technologies, making learning more accessible, flexible, and personalized than ever before.</p><p>Online learning platforms have democratized education, breaking down geographical and financial barriers that once limited access to quality education.</p><h3>Benefits of Online Learning</h3><ul><li>Flexibility and Convenience</li><li>Access to Global Resources</li><li>Personalized Learning Paths</li><li>Cost-Effectiveness</li></ul><p>As technology continues to advance, we can expect even more innovative approaches to education that will further enhance the learning experience for students worldwide.</p>',
                'status'           => true,
            ],
            [
                'blog_category_id' => $categories->where('name', 'Business')->first()->id ?? $categories->first()->id,
                'title'            => 'Digital Transformation in Business',
                'subtitle'         => 'How companies are adapting to the digital age',
                'content'          => '<h2>Digital Transformation in Business</h2><p>Digital transformation is not just about adopting new technologies; it\'s about fundamentally changing how businesses operate and deliver value to customers.</p><p>Companies that successfully navigate digital transformation can improve efficiency, enhance customer experiences, and gain competitive advantages in their markets.</p><h3>Key Areas of Digital Transformation</h3><ul><li>Cloud Computing and Infrastructure</li><li>Data Analytics and Business Intelligence</li><li>Customer Experience Optimization</li><li>Automation and Process Improvement</li></ul><p>The journey of digital transformation requires strong leadership, cultural change, and a commitment to continuous innovation.</p>',
                'status'           => true,
            ],
        ];

        foreach ($blogs as $blogData) {
            Blog::create($blogData);
        }

        $this->command->info('Blog posts seeded successfully!');
    }
}
