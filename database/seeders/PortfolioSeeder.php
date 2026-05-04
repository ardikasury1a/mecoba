<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Education;
use App\Models\Testimonial;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // Profile
        Profile::create([
            'name' => 'Ardika Surya Permadani',
            'tagline' => 'Professional Trader & Financial Analyst',
            'bio' => 'Trader berpengalaman dengan fokus pada analisis pasar modal dan manajemen risiko. Mengelola portofolio investasi dengan pendekatan disiplin dan terukur. Spesialis dalam scalping saham dan manajemen aset jangka menengah.',
            'email' => 'ardika.surya@example.com',
            'phone' => '+62 812 3456 7890',
            'address' => 'Jakarta, Indonesia',
            'github_url' => 'https://github.com/ardikasurya',
            'linkedin_url' => 'https://linkedin.com/in/ardikasurya',
            'instagram_url' => 'https://instagram.com/ardikasurya',
            'twitter_url' => 'https://twitter.com/ardikasurya',
            // English
            'name_en' => 'Ardika Surya Permadani',
            'tagline_en' => 'Professional Trader & Financial Analyst',
            'bio_en' => 'Experienced trader with a focus on capital market analysis and risk management. Managing investment portfolios with a disciplined and measured approach. Specialist in stock scalping and medium-term asset management.',
        ]);

        // Skills
        $skills = [
            ['name' => 'Laravel', 'icon' => 'laravel', 'level' => 95, 'category' => 'Backend', 'sort_order' => 1],
            ['name' => 'PHP', 'icon' => 'php', 'level' => 90, 'category' => 'Backend', 'sort_order' => 2],
            ['name' => 'MySQL', 'icon' => 'database', 'level' => 85, 'category' => 'Backend', 'sort_order' => 3],
            ['name' => 'REST API', 'icon' => 'api', 'level' => 88, 'category' => 'Backend', 'sort_order' => 4],
            ['name' => 'JavaScript', 'icon' => 'javascript', 'level' => 85, 'category' => 'Frontend', 'sort_order' => 5],
            ['name' => 'Tailwind CSS', 'icon' => 'tailwind', 'level' => 92, 'category' => 'Frontend', 'sort_order' => 6],
            ['name' => 'Alpine.js', 'icon' => 'alpine', 'level' => 88, 'category' => 'Frontend', 'sort_order' => 7],
            ['name' => 'Livewire', 'icon' => 'livewire', 'level' => 90, 'category' => 'Frontend', 'sort_order' => 8],
            ['name' => 'Vue.js', 'icon' => 'vue', 'level' => 80, 'category' => 'Frontend', 'sort_order' => 9],
            ['name' => 'Docker', 'icon' => 'docker', 'level' => 75, 'category' => 'DevOps', 'sort_order' => 10],
            ['name' => 'Git', 'icon' => 'git', 'level' => 90, 'category' => 'DevOps', 'sort_order' => 11],
            ['name' => 'Figma', 'icon' => 'figma', 'level' => 82, 'category' => 'Design', 'sort_order' => 12],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Experiences
        $experiences = [
            [
                'company' => 'PT Teknologi Nusantara',
                'position' => 'Senior Full-Stack Developer',
                'description' => 'Memimpin tim pengembangan dalam membangun platform e-commerce skala besar dengan Laravel dan Vue.js. Mengimplementasikan arsitektur microservices dan CI/CD pipeline.',
                'start_date' => '2022-03-01',
                'end_date' => null,
                'is_current' => true,
                'sort_order' => 1,
                'position_en' => 'Senior Full-Stack Developer',
                'description_en' => 'Leading the development team in building a large-scale e-commerce platform with Laravel and Vue.js. Implementing microservices architecture and CI/CD pipeline.',
            ],
            [
                'company' => 'Startup Digital Indonesia',
                'position' => 'Full-Stack Developer',
                'description' => 'Mengembangkan dan memelihara beberapa aplikasi web menggunakan TALL stack. Berkolaborasi dengan tim desain untuk membuat antarmuka yang responsif dan user-friendly.',
                'start_date' => '2020-06-01',
                'end_date' => '2022-02-28',
                'is_current' => false,
                'sort_order' => 2,
                'position_en' => 'Full-Stack Developer',
                'description_en' => 'Developed and maintained multiple web applications using the TALL stack. Collaborated with the design team to create responsive and user-friendly interfaces.',
            ],
            [
                'company' => 'Agency Kreatif',
                'position' => 'Junior Web Developer',
                'description' => 'Membangun website klien menggunakan Laravel dan WordPress. Belajar best practices dalam pengembangan web dan version control.',
                'start_date' => '2019-01-01',
                'end_date' => '2020-05-31',
                'is_current' => false,
                'sort_order' => 3,
                'position_en' => 'Junior Web Developer',
                'description_en' => 'Built client websites using Laravel and WordPress. Learned best practices in web development and version control.',
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::create($exp);
        }

        // Projects
        $projects = [
            [
                'title' => 'E-Commerce Platform',
                'slug' => 'e-commerce-platform',
                'description' => 'Platform e-commerce lengkap dengan sistem pembayaran, manajemen inventori, dan dashboard analytics. Dibangun dengan Laravel, Livewire, dan Tailwind CSS.',
                'tech_stack' => ['Laravel', 'Livewire', 'Tailwind CSS', 'MySQL', 'Redis'],
                'live_url' => 'https://demo-ecommerce.test',
                'github_url' => 'https://github.com/ahmadrizki/ecommerce',
                'category' => 'Web App',
                'is_featured' => true,
                'sort_order' => 1,
                'title_en' => 'E-Commerce Platform',
                'description_en' => 'A complete e-commerce platform with payment system, inventory management, and analytics dashboard. Built with Laravel, Livewire, and Tailwind CSS.',
            ],
            [
                'title' => 'Task Management System',
                'slug' => 'task-management-system',
                'description' => 'Aplikasi manajemen tugas real-time dengan fitur Kanban board, notifikasi, dan kolaborasi tim. Menggunakan WebSocket untuk update instan.',
                'tech_stack' => ['Laravel', 'Vue.js', 'Pusher', 'PostgreSQL'],
                'live_url' => 'https://demo-taskman.test',
                'github_url' => 'https://github.com/ahmadrizki/taskman',
                'category' => 'Web App',
                'is_featured' => true,
                'sort_order' => 2,
                'title_en' => 'Task Management System',
                'description_en' => 'A real-time task management app with Kanban board, notifications, and team collaboration features. Uses WebSocket for instant updates.',
            ],
            [
                'title' => 'Portfolio CMS',
                'slug' => 'portfolio-cms',
                'description' => 'Sistem manajemen konten untuk portfolio profesional dengan admin panel Filament. Mendukung multi-bahasa dan tema gelap.',
                'tech_stack' => ['Laravel', 'Filament', 'Alpine.js', 'Tailwind CSS'],
                'github_url' => 'https://github.com/ahmadrizki/portfolio-cms',
                'category' => 'CMS',
                'is_featured' => true,
                'sort_order' => 3,
                'title_en' => 'Portfolio CMS',
                'description_en' => 'A content management system for professional portfolios with Filament admin panel. Supports multi-language and dark theme.',
            ],
            [
                'title' => 'Weather Dashboard',
                'slug' => 'weather-dashboard',
                'description' => 'Dashboard cuaca interaktif dengan visualisasi data menggunakan Chart.js dan integrasi API OpenWeatherMap.',
                'tech_stack' => ['Laravel', 'Alpine.js', 'Chart.js', 'API'],
                'live_url' => 'https://demo-weather.test',
                'category' => 'Dashboard',
                'is_featured' => false,
                'sort_order' => 4,
                'title_en' => 'Weather Dashboard',
                'description_en' => 'An interactive weather dashboard with data visualization using Chart.js and OpenWeatherMap API integration.',
            ],
            [
                'title' => 'REST API Boilerplate',
                'slug' => 'rest-api-boilerplate',
                'description' => 'Boilerplate REST API dengan authentication JWT, rate limiting, dan dokumentasi Swagger otomatis.',
                'tech_stack' => ['Laravel', 'JWT', 'Swagger', 'PHPUnit'],
                'github_url' => 'https://github.com/ahmadrizki/api-boilerplate',
                'category' => 'API',
                'is_featured' => false,
                'sort_order' => 5,
                'title_en' => 'REST API Boilerplate',
                'description_en' => 'A REST API boilerplate with JWT authentication, rate limiting, and auto-generated Swagger documentation.',
            ],
            [
                'title' => 'Social Media Analytics',
                'slug' => 'social-media-analytics',
                'description' => 'Tool analitik media sosial yang mengumpulkan dan memvisualisasikan data dari berbagai platform.',
                'tech_stack' => ['Laravel', 'Vue.js', 'D3.js', 'MongoDB'],
                'category' => 'Analytics',
                'is_featured' => false,
                'sort_order' => 6,
                'title_en' => 'Social Media Analytics',
                'description_en' => 'A social media analytics tool that collects and visualizes data from various platforms.',
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        // Education
        $educations = [
            [
                'institution' => 'Universitas Indonesia',
                'degree' => 'Sarjana Komputer (S.Kom)',
                'field_of_study' => 'Ilmu Komputer',
                'start_year' => 2015,
                'end_year' => 2019,
                'description' => 'Lulus dengan predikat Cum Laude. Aktif dalam organisasi kemahasiswaan dan komunitas developer.',
                'sort_order' => 1,
                'degree_en' => 'Bachelor of Computer Science',
                'field_of_study_en' => 'Computer Science',
                'description_en' => 'Graduated Cum Laude. Active in student organizations and developer communities.',
            ],
            [
                'institution' => 'SMA Negeri 1 Jakarta',
                'degree' => 'SMA',
                'field_of_study' => 'IPA',
                'start_year' => 2012,
                'end_year' => 2015,
                'description' => 'Juara 1 Olimpiade Informatika tingkat provinsi.',
                'sort_order' => 2,
                'degree_en' => 'High School',
                'field_of_study_en' => 'Science',
                'description_en' => 'First place in Provincial Computer Science Olympiad.',
            ],
        ];

        foreach ($educations as $edu) {
            Education::create($edu);
        }

        // Testimonials
        $testimonials = [
            [
                'name' => 'Budi Santoso',
                'position' => 'CEO',
                'company' => 'PT Teknologi Nusantara',
                'content' => 'Ahmad adalah developer yang sangat berbakat dan dedicated. Kontribusinya terhadap proyek kami sangat signifikan. Kode yang dihasilkan selalu berkualitas tinggi dan well-documented.',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 1,
                'content_en' => 'Ahmad is a very talented and dedicated developer. His contribution to our project has been very significant. The code he produces is always high-quality and well-documented.',
            ],
            [
                'name' => 'Siti Rahmawati',
                'position' => 'Product Manager',
                'company' => 'Startup Digital Indonesia',
                'content' => 'Bekerja dengan Ahmad selalu menyenangkan. Dia tidak hanya mengerti teknologi, tapi juga memahami kebutuhan bisnis. Solusi yang ditawarkan selalu tepat sasaran.',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 2,
                'content_en' => 'Working with Ahmad is always a pleasure. He not only understands technology, but also comprehends business needs. The solutions he offers are always on point.',
            ],
            [
                'name' => 'David Chen',
                'position' => 'CTO',
                'company' => 'TechVentures Asia',
                'content' => 'Salah satu developer terbaik yang pernah saya temui. Kemampuan problem-solving dan attention to detail-nya luar biasa. Sangat direkomendasikan!',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 3,
                'content_en' => 'One of the best developers I have ever met. His problem-solving skills and attention to detail are extraordinary. Highly recommended!',
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
