-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2025 at 02:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sadiq_sir_lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `subtitle`, `description`, `image`, `features`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Innovating the Future Through Technology', 'Leading Research in Computer Science & Engineering', 'Our advanced research lab, under the guidance of expert faculty, is committed to driving innovation in computing. We focus on cutting-edge technologies and real-world applications in areas such as artificial intelligence, cybersecurity, data science, and smart systems. Our mission is to empower students and researchers to build the technology of tomorrow.', 'abouts/about-img1.png', '[\"Artificial Intelligence\",\"Cybersecurity & Privacy\",\"Data Science & Analytics\",\"Internet of Things (IoT)\",\"Machine Learning Models\",\"Cloud Computing\",\"Robotics & Automation\",\"High Performance Computing\"]', 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `action_button_text` varchar(255) NOT NULL,
  `action_button_link` varchar(255) NOT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `subtitle`, `description`, `action_button_text`, `action_button_link`, `banner_image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Where Innovation Meets Intelligence', 'Computer Science & Engineering Lab', 'Welcome to our advanced research lab led by Prof. Sadiq Iqbal, Head of the CSE Department. We explore next-gen technologies, foster creativity, and drive innovation in computing and engineering.', 'Make Appointment', '/contact', 'banners/banner-img1.png', 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` longtext NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `blog_category_id`, `title`, `subtitle`, `image`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'The Future of Artificial Intelligence', 'Exploring the latest developments in AI and machine learning', NULL, '<h2>The Future of Artificial Intelligence</h2><p>Artificial Intelligence (AI) is rapidly transforming the way we live and work. From virtual assistants to autonomous vehicles, AI technologies are becoming increasingly integrated into our daily lives.</p><p>Recent developments in machine learning algorithms have enabled computers to perform tasks that were once thought to be exclusively human, such as natural language processing, image recognition, and decision-making.</p><h3>Key Trends in AI</h3><ul><li>Deep Learning and Neural Networks</li><li>Natural Language Processing</li><li>Computer Vision</li><li>Robotics and Automation</li></ul><p>As we look to the future, AI will continue to evolve and impact various industries, from healthcare to finance, creating new opportunities and challenges for society.</p>', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(2, 2, 'Breakthrough in Quantum Computing', 'Scientists achieve quantum supremacy in computational tasks', NULL, '<h2>Breakthrough in Quantum Computing</h2><p>Quantum computing represents a paradigm shift in computational power, leveraging the principles of quantum mechanics to process information in ways that classical computers cannot.</p><p>Recent breakthroughs have demonstrated quantum supremacy, where quantum computers solve problems that would take classical supercomputers thousands of years to complete.</p><h3>Applications of Quantum Computing</h3><ul><li>Cryptography and Security</li><li>Drug Discovery and Molecular Modeling</li><li>Optimization Problems</li><li>Climate Modeling</li></ul><p>This technology has the potential to revolutionize fields such as cryptography, drug discovery, and complex system modeling.</p>', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(3, 3, 'Advances in Precision Medicine', 'Personalized treatment approaches for better patient outcomes', NULL, '<h2>Advances in Precision Medicine</h2><p>Precision medicine is revolutionizing healthcare by tailoring medical treatment to individual characteristics, including genetic makeup, lifestyle, and environment.</p><p>This approach moves away from the traditional \"one-size-fits-all\" model and towards personalized care that considers each patient\'s unique profile.</p><h3>Key Components of Precision Medicine</h3><ul><li>Genomic Sequencing</li><li>Biomarker Analysis</li><li>Targeted Therapies</li><li>Digital Health Technologies</li></ul><p>Precision medicine holds promise for treating complex diseases like cancer, cardiovascular disorders, and rare genetic conditions with greater effectiveness and fewer side effects.</p>', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(4, 5, 'The Evolution of Online Learning', 'How digital platforms are reshaping education', NULL, '<h2>The Evolution of Online Learning</h2><p>The landscape of education has been dramatically transformed by digital technologies, making learning more accessible, flexible, and personalized than ever before.</p><p>Online learning platforms have democratized education, breaking down geographical and financial barriers that once limited access to quality education.</p><h3>Benefits of Online Learning</h3><ul><li>Flexibility and Convenience</li><li>Access to Global Resources</li><li>Personalized Learning Paths</li><li>Cost-Effectiveness</li></ul><p>As technology continues to advance, we can expect even more innovative approaches to education that will further enhance the learning experience for students worldwide.</p>', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(5, 1, 'Digital Transformation in Business', 'How companies are adapting to the digital age', NULL, '<h2>Digital Transformation in Business</h2><p>Digital transformation is not just about adopting new technologies; it\'s about fundamentally changing how businesses operate and deliver value to customers.</p><p>Companies that successfully navigate digital transformation can improve efficiency, enhance customer experiences, and gain competitive advantages in their markets.</p><h3>Key Areas of Digital Transformation</h3><ul><li>Cloud Computing and Infrastructure</li><li>Data Analytics and Business Intelligence</li><li>Customer Experience Optimization</li><li>Automation and Process Improvement</li></ul><p>The journey of digital transformation requires strong leadership, cultural change, and a commitment to continuous innovation.</p>', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Technology', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(2, 'Science', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(3, 'Health & Medicine', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(4, 'Research', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(5, 'Education', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(6, 'Innovation', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(7, 'Industry News', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(8, 'Case Studies', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read','replied') NOT NULL DEFAULT 'unread',
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ctas`
--

CREATE TABLE `ctas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `button_text` varchar(255) NOT NULL DEFAULT 'Contact Us',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ctas`
--

INSERT INTO `ctas` (`id`, `title`, `subtitle`, `description`, `phone_number`, `button_text`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'We\'ll ensure you always get the best Results', 'Leading Laboratory Research & Innovation', 'Our state-of-the-art laboratory facility is dedicated to advancing scientific research and providing cutting-edge solutions for healthcare, environmental science, and industrial applications. With decades of experience and a team of expert researchers, we deliver accurate, reliable results that drive innovation and progress.', '+0112343874444', 'Contact Us', 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `content` longtext NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `subtitle`, `content`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Diabetes Testing Seminar', 'Understanding diabetes and testing methods', '<h2>Seminar Overview</h2><p>Comprehensive seminar on diabetes testing and management.</p><h3>Topics Covered</h3><ul><li>Diabetes types and symptoms</li><li>Testing methodologies</li><li>Prevention strategies</li></ul><h3>Target Audience</h3><p>Healthcare professionals and researchers.</p>', 'flaticon-sugar-blood-level', 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28'),
(3, 'Pathology Testing Conference', 'Latest developments in pathology testing', '<h2>Conference Overview</h2><p>International conference on pathology testing advancements.</p><h3>Key Sessions</h3><ul><li>Molecular pathology</li><li>Digital pathology</li><li>Quality assurance</li></ul><h3>Networking</h3><p>Connect with leading experts in the field.</p>', 'flaticon-computer', 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_01_000000_create_publications_table', 1),
(5, '2025_01_01_000000_create_settings_table', 1),
(6, '2025_01_01_000001_create_project_categories_table', 1),
(7, '2025_01_01_000002_create_projects_table', 1),
(8, '2025_01_01_000003_create_events_table', 1),
(9, '2025_01_02_000000_create_teams_table', 1),
(10, '2025_01_15_000000_create_social_media_table', 1),
(11, '2025_08_31_112710_create_banners_table', 1),
(12, '2025_08_31_114229_update_banners_table_allow_null_image', 1),
(13, '2025_08_31_170211_create_research_areas_table', 1),
(14, '2025_08_31_171648_create_abouts_table', 1),
(15, '2025_08_31_172807_create_services_table', 1),
(16, '2025_08_31_174240_create_ctas_table', 1),
(17, '2025_09_01_043241_create_blog_categories_table', 1),
(18, '2025_09_01_045632_create_blogs_table', 1),
(19, '2025_09_01_060920_create_news_table', 1),
(20, '2025_09_01_081629_create_contact_messages_table', 1),
(21, '2025_09_02_055057_remove_sort_order_from_social_media_table', 1),
(22, '2025_09_03_103945_add_profile_fields_to_users_table', 2),
(23, '2025_09_03_105747_create_newsletter_subscribers_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` longtext NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `image`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Breakthrough in Antibody Half-Life Research', 'Our latest research reveals new insights into improving antibody half-life measurements, potentially revolutionizing therapeutic treatments.', NULL, '<p>Scientists at our laboratory have made significant strides in understanding antibody half-life dynamics. This breakthrough research could lead to more effective therapeutic treatments and improved patient outcomes.</p>\r\n\r\n                <h3>Key Findings</h3>\r\n                <ul>\r\n                    <li>Novel measurement techniques increase accuracy by 40%</li>\r\n                    <li>Improved stability markers identified</li>\r\n                    <li>Enhanced therapeutic potential demonstrated</li>\r\n                </ul>\r\n\r\n                <p>The research team, led by Dr. Sarah Johnson, utilized advanced spectroscopic methods to analyze antibody degradation patterns. Their findings suggest that current therapeutic dosing schedules could be optimized based on these new measurements.</p>\r\n\r\n                <h3>Clinical Implications</h3>\r\n                <p>These discoveries have immediate implications for clinical practice, potentially allowing for:</p>\r\n                <ul>\r\n                    <li>Reduced treatment frequency</li>\r\n                    <li>Lower patient burden</li>\r\n                    <li>Cost-effective therapy options</li>\r\n                </ul>', 1, '2025-08-26 02:16:29', '2025-08-26 02:16:29'),
(2, 'New Mouse Model for Rare Disease Research', 'Development of an innovative mouse model opens new avenues for studying rare genetic diseases and potential therapeutic interventions.', NULL, '<p>Our research team has successfully developed a versatile mouse model that mimics rare genetic diseases, providing researchers worldwide with a powerful tool for drug discovery and therapeutic development.</p>\r\n\r\n                <h3>Model Characteristics</h3>\r\n                <p>The new mouse model exhibits:</p>\r\n                <ul>\r\n                    <li>High genetic similarity to human conditions</li>\r\n                    <li>Reproducible disease progression</li>\r\n                    <li>Enhanced therapeutic screening capabilities</li>\r\n                </ul>\r\n\r\n                <p>Dr. Michael Chen, the lead researcher, explained: \"This model represents a significant advancement in rare disease research. It provides a more accurate representation of human pathology than previous models.\"</p>\r\n\r\n                <h3>Research Applications</h3>\r\n                <p>The model is already being used to investigate:</p>\r\n                <ul>\r\n                    <li>Gene therapy approaches</li>\r\n                    <li>Small molecule interventions</li>\r\n                    <li>Disease mechanism studies</li>\r\n                </ul>\r\n\r\n                <p>We expect this tool to accelerate research timelines and improve the translation of laboratory findings to clinical applications.</p>', 1, '2025-08-19 02:16:29', '2025-08-19 02:16:29'),
(3, 'Laboratory Safety Protocol Updates', 'New safety protocols implemented across all laboratory facilities to ensure the highest standards of researcher and environmental protection.', NULL, '<p>In our ongoing commitment to safety excellence, we have implemented comprehensive updates to our laboratory safety protocols. These changes reflect the latest industry standards and regulatory requirements.</p>\r\n\r\n                <h3>Key Protocol Updates</h3>\r\n                <ul>\r\n                    <li>Enhanced chemical handling procedures</li>\r\n                    <li>Updated emergency response protocols</li>\r\n                    <li>Improved personal protective equipment standards</li>\r\n                    <li>Advanced waste management systems</li>\r\n                </ul>\r\n\r\n                <p>All laboratory personnel have completed mandatory training sessions on the new protocols. The safety team, led by Dr. Emily Rodriguez, conducted comprehensive workshops covering theoretical knowledge and practical applications.</p>\r\n\r\n                <h3>Training and Compliance</h3>\r\n                <p>The implementation includes:</p>\r\n                <ul>\r\n                    <li>Monthly safety audits</li>\r\n                    <li>Quarterly training refreshers</li>\r\n                    <li>Real-time monitoring systems</li>\r\n                    <li>Incident reporting improvements</li>\r\n                </ul>\r\n\r\n                <p>These measures ensure that our laboratory maintains its reputation as a leader in safety excellence while supporting cutting-edge research activities.</p>', 1, '2025-08-12 02:16:29', '2025-08-12 02:16:29'),
(4, 'International Research Collaboration Announced', 'Exciting new partnership with leading international institutions will expand our research capabilities and global impact.', NULL, '<p>We are thrilled to announce a groundbreaking international collaboration with research institutions across three continents. This partnership will significantly enhance our research capabilities and global scientific impact.</p>\r\n\r\n                <h3>Partner Institutions</h3>\r\n                <ul>\r\n                    <li>European Molecular Biology Laboratory (EMBL)</li>\r\n                    <li>Riken Institute, Japan</li>\r\n                    <li>National Institutes of Health (NIH), USA</li>\r\n                    <li>Max Planck Institute, Germany</li>\r\n                </ul>\r\n\r\n                <p>The collaboration focuses on advancing our understanding of molecular mechanisms in disease progression and developing innovative therapeutic approaches.</p>\r\n\r\n                <h3>Research Focus Areas</h3>\r\n                <p>Joint research efforts will concentrate on:</p>\r\n                <ul>\r\n                    <li>Precision medicine development</li>\r\n                    <li>Advanced imaging techniques</li>\r\n                    <li>Computational biology applications</li>\r\n                    <li>Drug delivery systems</li>\r\n                </ul>\r\n\r\n                <p>Dr. James Wilson, our Director of International Relations, stated: \"This collaboration represents a new chapter in our research journey. By combining expertise from leading institutions worldwide, we can tackle complex scientific challenges more effectively.\"</p>\r\n\r\n                <h3>Expected Outcomes</h3>\r\n                <p>The partnership is expected to produce:</p>\r\n                <ul>\r\n                    <li>Joint publications in top-tier journals</li>\r\n                    <li>Shared research infrastructure</li>\r\n                    <li>Student and researcher exchange programs</li>\r\n                    <li>Accelerated translation of research findings</li>\r\n                </ul>', 1, '2025-08-03 02:16:29', '2025-08-03 02:16:29'),
(5, 'Grant Funding Success for Cancer Research', 'Significant funding secured for innovative cancer research project focused on early detection and personalized treatment approaches.', NULL, '<p>We are pleased to announce that our cancer research team has secured substantial funding from the National Cancer Institute for a pioneering project focused on early detection and personalized treatment strategies.</p>\r\n\r\n                <h3>Project Overview</h3>\r\n                <p>The five-year project, valued at $2.5 million, will investigate:</p>\r\n                <ul>\r\n                    <li>Novel biomarker discovery</li>\r\n                    <li>Advanced diagnostic techniques</li>\r\n                    <li>Personalized therapy development</li>\r\n                    <li>Treatment response prediction</li>\r\n                </ul>\r\n\r\n                <p>Principal Investigator Dr. Lisa Thompson expressed her excitement: \"This funding allows us to pursue innovative approaches that could revolutionize cancer care. Our focus on personalized medicine has the potential to significantly improve patient outcomes.\"</p>\r\n\r\n                <h3>Research Team</h3>\r\n                <p>The project brings together experts from multiple disciplines:</p>\r\n                <ul>\r\n                    <li>Molecular biologists</li>\r\n                    <li>Computational scientists</li>\r\n                    <li>Clinical researchers</li>\r\n                    <li>Biostatisticians</li>\r\n                </ul>\r\n\r\n                <h3>Timeline and Milestones</h3>\r\n                <p>Key project milestones include:</p>\r\n                <ul>\r\n                    <li>Year 1: Biomarker identification and validation</li>\r\n                    <li>Year 2-3: Diagnostic platform development</li>\r\n                    <li>Year 4-5: Clinical validation and implementation</li>\r\n                </ul>\r\n\r\n                <p>The research is expected to generate significant intellectual property and potentially lead to spin-off companies focused on commercializing the developed technologies.</p>', 1, '2025-07-19 02:16:29', '2025-07-19 02:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` enum('active','inactive','unsubscribed') NOT NULL DEFAULT 'active',
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `unsubscribed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`id`, `email`, `status`, `subscribed_at`, `unsubscribed_at`, `created_at`, `updated_at`) VALUES
(2, 'testuser12121@gma.com', 'active', '2025-09-03 05:28:30', NULL, '2025-09-03 05:28:30', '2025-09-03 05:28:30'),
(3, 'tsdfestuser12121@gma.com', 'active', '2025-09-03 05:29:15', NULL, '2025-09-03 05:29:15', '2025-09-03 05:29:15'),
(4, 'lab@sadiqsir.com', 'active', '2025-09-03 05:29:24', NULL, '2025-09-03 05:29:24', '2025-09-03 05:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `project_category_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `subtitle`, `content`, `image`, `project_category_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Nuclear Micro-reactors Research', 'Advanced nuclear technology for sustainable energy solutions', '<h2>Project Overview</h2><p>This research project focuses on developing advanced nuclear micro-reactors for sustainable energy solutions.</p><h3>Research Objectives</h3><ul><li>Design and develop compact nuclear reactors</li><li>Improve safety and efficiency standards</li><li>Reduce environmental impact</li></ul><h3>Expected Outcomes</h3><p>This project aims to revolutionize the nuclear energy sector with safer, more efficient micro-reactor technology.</p>', 'projects/M3VLkwp02GrUpQaDItjxIZNPRUNDvFjG4Jgcu19S.png', 1, 1, '2025-09-02 02:16:28', '2025-09-02 02:31:20'),
(2, 'Metabolism Regulation Study', 'Understanding cellular metabolism for medical applications', '<h2>Project Overview</h2><p>This study investigates cellular metabolism regulation for potential medical applications.</p><h3>Research Focus</h3><ul><li>Cellular metabolism pathways</li><li>Regulatory mechanisms</li><li>Medical applications</li></ul><h3>Impact</h3><p>This research could lead to new treatments for metabolic disorders.</p>', NULL, 2, 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28'),
(3, 'Translational Research Initiative', 'Bridging laboratory discoveries to clinical applications', '<h2>Project Overview</h2><p>This initiative focuses on translating laboratory discoveries into clinical applications.</p><h3>Goals</h3><ul><li>Bridge research and clinical practice</li><li>Accelerate drug development</li><li>Improve patient outcomes</li></ul><h3>Methodology</h3><p>Using advanced laboratory techniques to validate clinical hypotheses.</p>', NULL, 3, 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `project_categories`
--

CREATE TABLE `project_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_categories`
--

INSERT INTO `project_categories` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Laboratory Research', 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28'),
(2, 'Medical Technology', 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28'),
(3, 'Environmental Analysis', 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28'),
(4, 'Chemical Analysis', 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28'),
(5, 'Biotechnology', 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `publications`
--

CREATE TABLE `publications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` longtext NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publications`
--

INSERT INTO `publications` (`id`, `content`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '<h2>Our Research Publications</h2><p>Welcome to our publications section where we showcase our latest research and findings in laboratory sciences.</p><h3>Recent Research Areas</h3><p>Our team has been actively working on several key areas of research:</p><ul><li><strong>Advanced Analytical Techniques:</strong> Developing new methodologies for precise laboratory analysis</li><li><strong>Medical Laboratory Technology:</strong> Innovations in patient care and diagnostic accuracy</li><li><strong>Environmental Analysis:</strong> Sustainable approaches to laboratory testing</li></ul><h3>Research Methodology</h3><p>We employ state-of-the-art laboratory equipment and analytical techniques to ensure the highest standards of accuracy and reliability in our research.</p><h3>Future Directions</h3><p>Our ongoing research focuses on:</p><ul><li>Integration of AI and machine learning in laboratory processes</li><li>Development of green laboratory practices</li><li>Enhancement of diagnostic capabilities</li></ul><p>For more information about our research projects, please contact our team.</p>', 1, '2025-09-02 02:16:28', '2025-09-02 02:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `research_areas`
--

CREATE TABLE `research_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `background_color` varchar(255) NOT NULL DEFAULT 'bg-default',
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `research_areas`
--

INSERT INTO `research_areas` (`id`, `title`, `description`, `image`, `background_color`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Artificial Intelligence', 'Building intelligent systems that learn, adapt, and make decisions like humans.', 'research-areas/1.png', 'bg-43c784', 1, 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(2, 'Cybersecurity & Privacy', 'Protecting digital systems through secure architectures and threat detection.', 'research-areas/2.png', 'bg-fe5d24', 2, 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(3, 'Data Science & Analytics', 'Extracting meaningful insights from complex datasets to drive smart decisions.', 'research-areas/3.png', 'bg-f59f00', 3, 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(4, 'Internet of Things (IoT)', 'Connecting devices and systems to build smart, responsive environments.', 'research-areas/4.png', 'bg-43c784', 4, 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(5, 'High Performance Computing (HPC)', 'Solving large-scale problems with advanced computing power and parallel processing.', 'research-areas/5.png', 'bg-fe5d24', 5, 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `background_color` varchar(255) NOT NULL DEFAULT 'bg-default',
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `icon`, `background_color`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Advanced Robotics', 'Cutting-edge robotic systems for laboratory automation, precision testing, and research applications. Our advanced robotics solutions enhance efficiency and accuracy in scientific processes.', 'fas fa-robot', '#007bff', 1, 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28'),
(2, 'Diabetes Testing', 'Comprehensive diabetes screening and monitoring services using state-of-the-art equipment. We provide accurate blood glucose testing and comprehensive diabetes management solutions.', 'fas fa-heartbeat', '#28a745', 2, 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28'),
(3, 'Pathology Testing', 'Advanced pathological analysis and diagnostic services for accurate disease detection. Our expert pathologists use cutting-edge technology for precise tissue and cell analysis.', 'fas fa-microscope', '#ffc107', 3, 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28'),
(4, 'Healthcare Lab', 'Comprehensive healthcare laboratory services for medical diagnostics and research. We provide a wide range of clinical tests with rapid turnaround times and accurate results.', 'fas fa-flask', '#fd7e14', 4, 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28'),
(5, 'Alternative Energy', 'Research and development in sustainable energy solutions and environmental technologies. We focus on renewable energy sources and eco-friendly laboratory practices.', 'fas fa-leaf', '#20c997', 5, 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28'),
(6, 'Artificial Intelligence', 'AI-powered laboratory automation and data analysis for enhanced research capabilities. Our intelligent systems optimize processes and provide predictive analytics.', 'fas fa-brain', '#6f42c1', 6, 1, '2025-09-02 02:16:28', '2025-09-02 02:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9nGFZfpLSHjosr8wg8na2AVTud9akwA9px0nHLOs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUGUyT3BQdXk3Y1FCV3JKRTN3eUZIUXVnSFVqSHlPQkpVZlhMR3lXYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvbGlzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1756895604),
('aoQMBZoZQQOV2hwyZavIpjAhayzogktsl0GTUH1D', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWW1WUHZ3YU00WWxEb2ZzemIyQVdXeFc0cjVaR2ZYTHVMY25iaXNNRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvbGlzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1756899745),
('AypXoPJ716wEOLikutStdTe2wCwOST3ZqDVyPEJV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHkyQ000a3dNM0N1OThZc0NrWTU5SVV5UjdCc09xQ1hJQU8xRzd1USI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvcmVxdWVzdC1saXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1756900818),
('bOyyC5dOSENZhyfrgf57NWF5GfAsmStHebDwr4ig', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiODRXaDJRMTBHSzRTUkVmTk93RVNxUTZOVXBYVjE3bXhsN0NYU0VIMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvbGlzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1756895699),
('fFnv5e3Gwc6BAal9Gx3cXwgQ6xgKr5evRWD8BgiS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiamc0S0JRbGlYMG5zRUl6VmtyWlBNWkk0ODdCa2s1OEloT1JvU1NrayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvcmVxdWVzdC1saXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1756895416),
('fO1GiOT6xXjuoryUBsu92p50ixwMdrFmI6G4dZJ5', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoib0FNYzNiTmN1VU9EdHNONmNiY2xxRVFTd2lJVFg4WXZ4VE5GZjlNcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb250YWN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1756900291),
('iLX1B4PSGirnW6dTCuvrvviWDYInhUdOsNlNbToc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTGx6RGY5dEpxajVUTERNUUptMUZYY1lNNzJYYmlSTTNEaThBUG1peSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvcmVxdWVzdC1saXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1756899677),
('iNSafW5l2zrT8KrSNSmcfEpRh0u6qJXBzwgID8Ao', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVVCaEt4REc1c1dieUhSYmhBdUlYcDA0anpUNzR2Q1NzRnFPWThVdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvcmVxdWVzdC1saXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1756899707),
('jX2V6xfuO8yhrvfRbUg0PYEcfdn5IJ0VzAynYaEx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidTBFNGUxR2tHdHFOeUlRMEZsb2NCV29zQjlXRmtxZmREVmx5UXJhQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvbGlzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1756899679),
('ktcKYKZFlmD5YfuvAeFhG74h7Q7IynsSaG5wrILd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMXpkdjBoYVJBRzdFWFNYeFNjSGNROXQwaGVsd0NBVzZDRGNQd3hmMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvbGlzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1756895706),
('LGDw0SXTPHhSRK1F5U1isRPbajF18Oj6zhCehUCc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTXNlUHVxWk9QTm04Zm1PTmZ5SEFvM2FyY3plaG12NEZwRE55SmxhaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvbGlzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1756898416),
('lyE8k6QMb2Dtfv5NjC0V8tnJ6U6pEOr1NyqoI8Ah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicXliVkdGU0FnY3p2ZWNlUWhROU8wNlRaTzQzaERIRmtIRGNkdlVWeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvbGlzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1756900253),
('NSBqveUcsJgEzoM8EGc6rmUbPDTCiPGxy9L92CKg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQVBvY25jSTBmeHlBeG91SHgwTnNBQlRjdkpVSDQ3VGVKc3U4dlp1QSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvcmVxdWVzdC1saXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1756895707),
('ocyEgNOB1QpRqHkfAOOERvTi1FwOlf0SPWmkturi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVGE3T0dZdUNVRVhJcUxnOVRtVVp3VVZmTkFiZjQ2ZjhTV1VFZzZ4UyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvcmVxdWVzdC1saXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1756895654),
('OqhiUoAF710KCksLLLqr5gggSkqtRv6jq1xsvTGV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU2NzRHllc0RFckZlYnlqeUF1TXFPRE5mWGt2OUN2ZEpDdWRjQUxmQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvcmVxdWVzdC1saXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1756896119),
('QoSljjNoR6KecqQqwrWKpM1S86BiFF1MADfKFfIv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidklROVNhWEFyeG82YWltRE5WSDRheXozR0dLRjV0dUxHZTZpTXhjVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvcmVxdWVzdC1saXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1756895699),
('sdWIMjBfFYGfcCW1qQLu1tZUCXgIwhxF5JxfatMi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVJqamRWTEN2bk5kYjJpQmVVWjd1Y21sb2lhbndjYk9sbVkwTXoycCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvcmVxdWVzdC1saXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1756897123),
('TwkT22HQek2TzGIx8aUYPwLTVqxGPVoIRcLpPXa0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidUxDaFNoZWJCSjl6dTM2ZkZUWWlrS2NuRHN1azVWM3l1RTVPNVR1TiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvbGlzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1756895654),
('TwSq7FFLXGtNDbMbF0UWMf6MpaTml4qG6Q4Rc7oc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZHBYekFIQ0NDa1FIY0NiQ3J4ekExOXBEa1FhM1UyN1VOaFJrVXczcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvcmVxdWVzdC1saXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1756900255),
('u83B2g9owJquJzOTPLnpfSnaXfcDmnYbb3l82q0C', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3prdEIzOHN0aFlRS3ZlTXRITVlMQTZPMlpJb2Z4MVZObHhpSDd5SCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvcmVxdWVzdC1saXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1756898416),
('uo6BBJWTIxngIfJvDb4W27NFCzXFgVIiu6Vq6hzl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWkt1WnA5OEE0RE9aUm9BRFhUNWFrUk0wVHBLU1FrSTRiSUhwM3Z4RSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvbGlzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1756898993),
('VJWqzKjAJpuNXzIoyTGLPgIayZW175syOR8vQzWK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV2lqcnBHVmE0dVFvdXlodUpEc3o4ZXU0bFRCVmZVSkp0d2dUR1hpcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvbGlzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1756899705),
('wehJDTZyE3zpnHywL5ntREEl3XhgpFYMa4ixfCR2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGZBVFhuRzIzdUZxbG8yaUx3cDVDNlVGaElCR1dIRmhjV3VPRTB2biI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvbGlzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1756896118),
('Wntgi6pUO7y2viwGuLJjVRK5KBb4LqHzWGYHZWCe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibmQ1QkJjQWYwb2duREtYWXZqSkRBYnB6ZnJVOTJuZTE2V0ZPM3ZpNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvbGlzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1756895415),
('Wo8SByLM2RICgJpFc49UMARqXfMZ9qyhYdGZhe81', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidEhoSThYQVR2cVpiYnN0WFZrM1J3bk5MTWxMdUhzekN4VlhBb3BnbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvcmVxdWVzdC1saXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1756899745),
('YR5D2LzS4yZBpysYi37BFo5WxtFGnigHzEKmmTxy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiajR4cjdsaU83T1BnSEtVMVdOV1Q4bmgxYXEwd2lpNXlnVEhlNGpHSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvbGlzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1756897120),
('YtIjJaT5z4fcwwFhQUUMNPcG8MTw5UYpJJoTFq13', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV1ZQNHNiaFhvWUdZUkk3S3g1bWVQZHA0ZjVGejhNU1VaV3B2dGRnUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvcmVxdWVzdC1saXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1756898994),
('Z4rFccBOCDXTllRfLqjLoxRXCp1OxRpn3ckUaN3V', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZlV2ZFV4T3ZzbWJGRTFZSzJycUdROGJqMzdRYUtTVnppWXhlRko4NiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly90ZXN0Y29tcGFueS5sb2NhbGhvc3Q6ODAwMC9hcGkvdGVuYW50LWNvdXBvbnMvcmVxdWVzdC1saXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1756895604);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Prof Sadiq Laboratory', 'text', 'general', '2025-09-02 02:16:29', '2025-09-02 03:06:58'),
(2, 'site_description', 'Leading research laboratory and scientific services', 'text', 'general', '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(3, 'footer_copyright', '© 2025 Sadiq Laboratory. All rights reserved.', 'text', 'general', '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(4, 'footer_description', 'Leading research laboratory providing cutting-edge scientific solutions and research services.', 'text', 'general', '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(5, 'contact_email', 'info@sadiq-laboratory.com', 'text', 'general', '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(6, 'contact_phone', '+1 (555) 123-4567', 'text', 'general', '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(7, 'contact_website', 'https://sadiq-laboratory.com', 'text', 'general', '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(8, 'contact_address', '123 Research Drive, Science City, SC 12345', 'text', 'general', '2025-09-02 02:16:29', '2025-09-02 02:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `platform` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `platform`, `url`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'facebook', 'https://www.facebook.com/yourlab', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(2, 'twitter', 'https://twitter.com/yourlab', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(3, 'instagram', 'https://www.instagram.com/yourlab', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(4, 'linkedin', 'https://www.linkedin.com/company/yourlab', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(5, 'youtube', 'https://www.youtube.com/yourlab', 1, '2025-09-02 02:16:29', '2025-09-02 02:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `designation` varchar(255) NOT NULL,
  `specialities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`specialities`)),
  `education` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`education`)),
  `experience` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`experience`)),
  `address` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `social_media` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_media`)),
  `password` varchar(255) NOT NULL,
  `role` enum('admin','team') NOT NULL DEFAULT 'team',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `image`, `designation`, `specialities`, `education`, `experience`, `address`, `phone`, `email`, `website`, `social_media`, `password`, `role`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', NULL, 'System Administrator', '[\"System Administration\",\"Project Management\",\"Team Leadership\"]', '[\"Master of Computer Science\",\"Bachelor of Information Technology\"]', '[\"5+ years in System Administration\",\"3+ years in Project Management\"]', '123 Admin Street, City, Country', '+1234567890', 'admin@example.com', 'https://example.com', '[{\"platform\":\"LinkedIn\",\"url\":\"https:\\/\\/linkedin.com\\/in\\/admin\"},{\"platform\":\"Twitter\",\"url\":\"https:\\/\\/twitter.com\\/admin\"}]', '$2y$12$lhxPGgJ8o0WhllePPtqTw.u9ZtXbtqb.REziO42aExmB9NMzAZCSe', 'admin', 1, NULL, '2025-09-02 02:16:28', '2025-09-02 02:16:28'),
(2, 'John Doe', NULL, 'Senior Developer', '[\"Laravel Development\",\"Vue.js\",\"API Development\"]', '[\"Bachelor of Computer Science\",\"Web Development Certification\"]', '[\"4+ years in Laravel Development\",\"2+ years in Frontend Development\"]', '456 Developer Avenue, City, Country', '+1234567891', 'john@example.com', 'https://johndoe.dev', '[{\"platform\":\"GitHub\",\"url\":\"https:\\/\\/github.com\\/johndoe\"},{\"platform\":\"LinkedIn\",\"url\":\"https:\\/\\/linkedin.com\\/in\\/johndoe\"}]', '$2y$12$AkrYt6Uy6ssY5yfkyOz8EOMvdiOmXXHMefOViOvYMFckgahwIyng6', 'team', 1, NULL, '2025-09-02 02:16:29', '2025-09-02 02:16:29'),
(3, 'Jane Smith', NULL, 'UI/UX Designer', '[\"User Interface Design\",\"User Experience\",\"Prototyping\"]', '[\"Bachelor of Design\",\"UX Design Certification\"]', '[\"3+ years in UI\\/UX Design\",\"2+ years in Prototyping\"]', '789 Design Street, City, Country', '+1234567892', 'jane@example.com', 'https://janesmith.design', '[{\"platform\":\"Behance\",\"url\":\"https:\\/\\/behance.net\\/janesmith\"},{\"platform\":\"Dribbble\",\"url\":\"https:\\/\\/dribbble.com\\/janesmith\"}]', '$2y$12$rCaRikxYF6pLCkjOp6f97u62Dl3R0FYJ.nVt29KckiE7rPKGpLFXi', 'team', 1, NULL, '2025-09-02 02:16:29', '2025-09-02 02:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `profile_image`, `bio`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', NULL, NULL, NULL, NULL, '2025-09-02 02:16:28', '$2y$12$OPWChvf0dJ4LobQduOngXu1q3tHi5c1l8/XShz0LkhfpvhjQ5XfPC', 'zFXhx5jpAi', '2025-09-02 02:16:28', '2025-09-02 02:16:28'),
(2, 'Admin', 'admin@example.com', '01231231231', 'adasda', 'users/6UvviS7qtq0bBBXB53WroUcRTgxA34BzLwpjVKv9.png', 'asdasd', '2025-09-02 02:16:28', '$2y$12$fOE4r6/ae4TdyktVtOc9ZOCFfSqvnagRD7tB4JmU5MCTYt1lbNgBW', NULL, '2025-09-02 02:16:28', '2025-09-03 04:46:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_blog_category_id_foreign` (`blog_category_id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctas`
--
ALTER TABLE `ctas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newsletter_subscribers_email_unique` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_project_category_id_foreign` (`project_category_id`);

--
-- Indexes for table `project_categories`
--
ALTER TABLE `project_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `research_areas`
--
ALTER TABLE `research_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teams_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ctas`
--
ALTER TABLE `ctas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project_categories`
--
ALTER TABLE `project_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `publications`
--
ALTER TABLE `publications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `research_areas`
--
ALTER TABLE `research_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_project_category_id_foreign` FOREIGN KEY (`project_category_id`) REFERENCES `project_categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
