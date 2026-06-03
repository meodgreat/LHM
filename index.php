<?php
include 'header-footer.php';
require_once 'db.php';

$stmt = $pdo->query('SELECT title, slug, summary, featured_image, created_at, category FROM blog_posts ORDER BY created_at DESC LIMIT 3');
$latest_posts = $stmt->fetchAll();

ob_start();
?>

<style>
        :root {
            --lhm-teal: #083d47;
            --lhm-blue: #3a8fab;
            --lhm-teal-light: #0d5c6b;
            --lhm-blue-light: #7eb8d4;
            --lhm-gray: #f9fafb;
            --lhm-white: #ffffff;
            --lhm-card-bg: #f1f6f7;
            --lhm-program-card: #e4eef1;
            --lhm-program-card-border: rgba(8, 61, 71, 0.08);
        }

        body {
            font-family: 'Comfortaa', cursive;
            scroll-behavior: smooth;
            overflow-x: hidden;
            background-color: var(--lhm-white);
            color: #4b5563;
        }

        .bg-lhm-teal { background-color: var(--lhm-teal); }
        .text-lhm-teal { color: var(--lhm-teal); }
        .bg-lhm-blue { background-color: var(--lhm-blue); }
        .text-lhm-blue { color: var(--lhm-blue); }
        .text-lhm-blue-light { color: var(--lhm-blue-light); }
        .bg-lhm-gray { background-color: var(--lhm-gray); }
        .bg-lhm-card { background-color: var(--lhm-card-bg); }

        .font-bold-title { font-weight: 800; }
        .btn-bold {
            box-shadow: 0 4px 0px 0px rgba(0,0,0,0.15);
            transition: all 0.2s ease;
        }
        .btn-bold:active {
            transform: translateY(2px);
            box-shadow: 0 2px 0px 0px rgba(0,0,0,0.1);
        }

        .bg-blob {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            filter: blur(120px);
            z-index: 0;
            opacity: 0.12;
            pointer-events: none;
        }
        .blob-teal { background: var(--lhm-teal); }
        .blob-blue { background: var(--lhm-blue); }

        .shape-divider {
            position: absolute;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            z-index: 1;
        }
        .shape-divider svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 80px;
        }

        .hero-soft-bg {
            background: linear-gradient(165deg, #0a4d56 0%, #083d47 45%, #062a32 100%);
        }
        .hero-pattern {
            background-image: radial-gradient(rgba(122, 184, 212, 0.14) 1px, transparent 1px);
            background-size: 28px 28px;
            opacity: 0.22;
        }

        .hover-card-zoom {
            transition: transform 0.35s ease, box-shadow 0.35s ease;
            position: relative;
            z-index: 10;
        }
        .hover-card-zoom:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 32px -12px rgba(8, 61, 71, 0.12);
        }

        .program-card-surface {
            background-color: var(--lhm-program-card);
            border: 1px solid var(--lhm-program-card-border);
        }
        .about-icon-box {
            transition: background-color 0.25s ease, color 0.25s ease, box-shadow 0.25s ease;
        }
        .program-icon-box {
            background: rgba(255, 255, 255, 0.65);
            transition: background-color 0.25s ease, color 0.25s ease, box-shadow 0.25s ease;
        }
        .group:hover .program-icon-box {
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 4px 14px rgba(8, 61, 71, 0.08);
        }

        .about-bg-soft {
            background: linear-gradient(180deg, #ffffff 0%, #f7fafb 50%, #ffffff 100%);
        }
        .programs-bg-soft {
            background: linear-gradient(180deg, var(--lhm-gray) 0%, #f4f8f9 45%, var(--lhm-gray) 100%);
        }

        .hero-copy {
            padding-top: clamp(4rem, 12vh, 6rem);
        }
        .hero-eyebrow {
            font-size: 0.7rem;
            letter-spacing: 0.18em;
            color: rgba(255, 255, 255, 0.94);
            background: rgba(58, 143, 171, 0.28);
            border: 1px solid rgba(255, 255, 255, 0.14);
        }
        .hero-title {
            font-size: clamp(1.5rem, 2vw + 1rem, 2.2rem);
            line-height: 1.3;
            letter-spacing: -0.01em;
            color: #f4fafb;
            font-weight: 700;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
        }
        .hero-lead {
            font-size: clamp(0.9rem, 1vw + 0.5rem, 1rem);
            line-height: 1.5;
            font-weight: 300;
            color: rgba(244, 250, 251, 0.85);
            max-width: 32rem;
        }

        .nav-link { position: relative; }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: var(--lhm-blue);
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .mobile-nav-menu { display: none; }
        .mobile-nav-menu.open { display: block; }
        @media (max-width: 767px) {
            .mobile-donate-hide { display: none; }
            .mobile-section-padding { padding-top: 2rem !important; padding-bottom: 5rem !important; }
            #home { 
                min-height: auto; 
                align-items: flex-start; 
                padding-top: 8rem; 
                padding-bottom: 3rem;
                margin-top: 0;
            }
            .hero-copy { padding-top: 1.5rem; }
            .hero-title {
                font-size: clamp(1.5rem, 6vw, 2rem);
                line-height: 1.4;
            }
            .hero-lead {
                font-size: clamp(0.95rem, 3.5vw, 1.1rem);
                line-height: 1.6;
            }
        }
    </style>

    <section id="home" class="relative min-h-screen flex items-center overflow-hidden hero-soft-bg">
        <div class="absolute inset-0 hero-pattern pointer-events-none"></div>
        <div class="bg-blob blob-blue -top-40 -right-20 opacity-[0.18]"></div>
        <div class="bg-blob blob-blue bottom-0 -left-40 opacity-[0.12]"></div>

        <div class="max-w-[90%] mx-auto px-6 relative z-10 w-full">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="hero-copy" data-aos="fade-right" data-aos-duration="1200">
                    <div class="inline-block px-4 py-1.5 hero-eyebrow rounded-full font-bold-title uppercase mb-6 text-lhm-blue-light">
                        WHOLE PERSON . COMMUNITY . LASTING IMPACT
                    </div>
                    <h3 class="hero-title mb-5">
                       Serving the Whole Person. Empowering Every Community. Lasting Impact.
                    </h3>
                    <p class="hero-lead mb-10">
                         Legacy Holistic Mission is an independent, non-profit organization dedicated to sustainable community development. By championing holistic transformation, LHM empowers individuals to build their own capacity, thrive on their own terms, and leave a lasting legacy for future generations.
                    </p>
                    <div class="flex flex-wrap gap-5 items-center">
                        <a href="#contact" class="bg-lhm-blue text-white px-8 py-3.5 rounded-xl transition-all shadow-lg font-bold btn-bold text-[0.95rem]">
                            Get Involved
                        </a>
                        <a href="programs.php" class="flex items-center gap-2 text-white/95 font-semibold hover:text-lhm-blue-light transition-colors group text-[0.95rem]">
                            Explore Programs
                            <i class="fas fa-arrow-right group-hover:translate-x-1.5 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <div class="relative max-w-lg mx-auto lg:mr-0 h-full max-h-[60vh] hidden md:flex items-center" data-aos="fade-left" data-aos-duration="1200">
                    <div class="relative z-10 rounded-[2.5rem] overflow-hidden shadow-[0_40px_80px_-20px_rgba(0,0,0,0.4)] border-[10px] border-white/10 backdrop-blur-sm h-full w-full group">
                        <img src="pexels-safari-consoler-3290243-11834966.jpg" alt="African Community Development" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    </div>
                    <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl z-20 max-w-[180px] border border-gray-50" data-aos="zoom-in" data-aos-delay="500">
                        <div class="w-10 h-10 bg-lhm-blue rounded-xl flex items-center justify-center text-white text-lg mb-3 shadow-md">
                            <i class="fas fa-heart"></i>
                        </div>
                        <p class="text-lhm-teal font-bold text-xs leading-snug">Empowering Every Community</p>
                    </div>
                    <div class="absolute -top-4 -right-4 bg-lhm-blue p-4 rounded-2xl shadow-2xl z-20 border border-white/20" data-aos="zoom-in" data-aos-delay="700">
                        <div class="flex items-center gap-2 text-white">
                            <div class="w-2 h-2 bg-white rounded-full opacity-90"></div>
                            <span class="font-bold text-xs tracking-wide">Lasting Impact</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   <section id="latest-news" class="py-24 relative bg-gray-50/50 overflow-hidden">
    <!-- Subtle Background Texture/Accents -->
    <div class="absolute top-1/2 left-0 -translate-y-1/2 w-72 h-72 bg-gradient-to-br from-lhm-blue/5 to-transparent rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-[92%] mx-auto px-4 sm:px-6 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block text-lhm-blue font-bold tracking-widest text-xs uppercase bg-blue-50 px-4 py-1.5 rounded-full mb-3">
                Latest News
            </span>
            <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight text-lhm-teal mb-4">Recent Field Updates</h2>
            <p class="max-w-2xl mx-auto text-gray-500 text-sm md:text-base leading-relaxed">
                Catch up with the three newest stories from our community projects and emergency missions.
            </p>
        </div>

        <!-- PHP Conditional Check -->
        <?php if (empty($latest_posts)): ?>
            <div class="text-center py-16 bg-white rounded-[2rem] shadow-sm max-w-xl mx-auto border border-gray-100 p-8" data-aos="fade-up">
                <div class="w-12 h-12 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-newspaper text-lg"></i>
                </div>
                <p class="text-gray-500 font-medium">No news items are available yet. Check back soon!</p>
            </div>
        <?php else: ?>
            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($latest_posts as $post): ?>
                    <article class="group bg-white rounded-[2rem] overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col" data-aos="fade-up">
                        
                        <!-- Image Container with Zoom Link -->
                        <a href="post.php?slug=<?php echo htmlspecialchars($post['slug']); ?>" class="block h-52 overflow-hidden relative bg-gray-100">
                            <img src="uploads/<?php echo htmlspecialchars($post['featured_image']); ?>" 
                                 alt="<?php echo htmlspecialchars($post['title']); ?>" 
                                 class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105">
                            <!-- Overlay Badge -->
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-md text-lhm-teal font-bold text-[10px] tracking-wider uppercase px-3 py-1 rounded-full shadow-sm">
                                <?php echo htmlspecialchars($post['category']); ?>
                            </div>
                        </a>

                        <!-- Card Body -->
                        <div class="p-8 flex flex-col justify-between flex-grow">
                            <div>
                                <!-- Date Stamp -->
                                <div class="flex items-center gap-2 text-gray-400 text-xs mb-3">
                                    <i class="far fa-calendar text-[11px]"></i>
                                    <span class="font-medium tracking-wide">
                                        <?php echo date('M d, Y', strtotime($post['created_at'])); ?>
                                    </span>
                                </div>

                                <!-- Post Title Link -->
                                <h3 class="text-xl md:text-2xl font-bold text-gray-900 group-hover:text-lhm-teal transition-colors duration-200 mb-3 line-clamp-2">
                                    <a href="post.php?slug=<?php echo htmlspecialchars($post['slug']); ?>">
                                        <?php echo htmlspecialchars($post['title']); ?>
                                    </a>
                                </h3>

                                <!-- Summary -->
                                <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">
                                    <?php echo htmlspecialchars($post['summary']); ?>
                                </p>
                            </div>

                            <!-- Interactive Call to Action Footer -->
                            <div class="pt-4 border-t border-gray-50">
                                <a href="post.php?slug=<?php echo htmlspecialchars($post['slug']); ?>" 
                                   class="inline-flex items-center gap-2 text-lhm-blue font-bold text-sm group/link transition-colors">
                                    <span>Read Full Story</span>
                                    <i class="fas fa-arrow-right text-xs transform group-hover/link:translate-x-1.5 transition-transform duration-200"></i>
                                </a>
                            </div>
                        </div>

                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

  <section id="about" class="py-24 bg-[#f9fafb] relative overflow-hidden flex items-center justify-center">
    
    <!-- Subtle Brand Background Blur to frame the section -->
    <div class="absolute top-[-10%] right-[-5%] w-[400px] h-[400px] rounded-full bg-[#3a8fab]/5 blur-[100px] pointer-events-none"></div>

    <div class="w-full max-w-6xl mx-auto px-6 relative z-10">
        
        <!-- Header Section: High Contrast Slate & Deep Teal -->
        <div class="text-center mb-16 max-w-3xl mx-auto" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 bg-[#083d47]/5 border border-[#083d47]/10 px-4 py-1.5 rounded-full mb-4">
                <span class="w-1.5 h-1.5 rounded-full bg-[#3a8fab]"></span>
                <span class="text-xs font-black uppercase tracking-widest text-[#083d47]">Who We Are</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-[#083d47] mb-4 tracking-tight uppercase">
                About Us
            </h2>
            <p class="text-slate-800 text-base md:text-lg font-bold leading-relaxed max-w-2xl mx-auto border-t-2 border-[#3a8fab]/20 pt-4">
                We are an independent, non-profit organization dedicated to holistic transformation across Africa.
            </p>
        </div>
        
        <!-- Three-Column Structural Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Card 1: Mission -->
            <div class="bg-white border-2 border-slate-100 p-8 rounded-[2rem] shadow-xl shadow-slate-200/40 flex flex-col justify-between transition-all duration-300 hover:border-[#3a8fab] hover:shadow-2xl hover:-translate-y-1 group" data-aos="fade-up" data-aos-delay="100">
                <div>
                    <!-- Solid High-Contrast Icon Frame -->
                    <div class="w-14 h-14 rounded-2xl bg-[#083d47] flex items-center justify-center text-white text-2xl mb-6 shadow-md shadow-[#083d47]/20 transition-colors duration-300 group-hover:bg-[#3a8fab]">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <!-- Ultra Bold Title -->
                    <h3 class="text-2xl font-black text-[#083d47] mb-3 tracking-tight">
                        Mission
                    </h3>
                    <!-- Crisp Deep-Slate Body Text -->
                    <p class="text-sm text-slate-700 font-bold leading-relaxed mb-6">
                        We serve the whole person, empower communities, and create lasting impact that transforms generations.
                    </p>
                </div>
                <!-- Action Link with Enhanced Hover States -->
                <a href="about.php#mission" class="inline-flex items-center gap-2 text-[#083d47] hover:text-[#3a8fab] font-black text-sm tracking-tight transition-colors duration-300 mt-auto">
                    Explore More 
                    <i class="fas fa-arrow-right transition-transform duration-300 group-hover:translate-x-1"></i>
                </a>
            </div>
            
            <!-- Card 2: Vision -->
            <div class="bg-white border-2 border-slate-100 p-8 rounded-[2rem] shadow-xl shadow-slate-200/40 flex flex-col justify-between transition-all duration-300 hover:border-[#3a8fab] hover:shadow-2xl hover:-translate-y-1 group" data-aos="fade-up" data-aos-delay="200">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-[#083d47] flex items-center justify-center text-white text-2xl mb-6 shadow-md shadow-[#083d47]/20 transition-colors duration-300 group-hover:bg-[#3a8fab]">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="text-2xl font-black text-[#083d47] mb-3 tracking-tight">
                        Vision
                    </h3>
                    <p class="text-sm text-slate-700 font-bold leading-relaxed mb-6">
                        To see thriving communities where the whole person is nurtured, communities are empowered, and lasting impact becomes a living legacy.
                    </p>
                </div>
                <a href="about.php#vision" class="inline-flex items-center gap-2 text-[#083d47] hover:text-[#3a8fab] font-black text-sm tracking-tight transition-colors duration-300 mt-auto">
                    Explore More 
                    <i class="fas fa-arrow-right transition-transform duration-300 group-hover:translate-x-1"></i>
                </a>
            </div>
            
            <!-- Card 3: Values -->
            <div class="bg-white border-2 border-slate-100 p-8 rounded-[2rem] shadow-xl shadow-slate-200/40 flex flex-col justify-between transition-all duration-300 hover:border-[#3a8fab] hover:shadow-2xl hover:-translate-y-1 group" data-aos="fade-up" data-aos-delay="300">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-[#083d47] flex items-center justify-center text-white text-2xl mb-6 shadow-md shadow-[#083d47]/20 transition-colors duration-300 group-hover:bg-[#3a8fab]">
                        <i class="fas fa-scale-balanced"></i>
                    </div>
                    <h3 class="text-2xl font-black text-[#083d47] mb-3 tracking-tight">
                        Values
                    </h3>
                    <p class="text-sm text-slate-700 font-bold leading-relaxed mb-6">
                        Rooted in Equity and Transparency, we foster local ownership and culturally grounded solutions for lasting impact.
                    </p>
                </div>
                <a href="about.php#values" class="inline-flex items-center gap-2 text-[#083d47] hover:text-[#3a8fab] font-black text-sm tracking-tight transition-colors duration-300 mt-auto">
                    Explore More 
                    <i class="fas fa-arrow-right transition-transform duration-300 group-hover:translate-x-1"></i>
                </a>
            </div>

        </div>
    </div>
</section>
   <section id="programs" class="relative overflow-hidden py-24 md:py-32 bg-gradient-to-b from-gray-50 to-white mobile-section-padding">
    <!-- Decorative Background Accents -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-50/50 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-teal-50/50 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10 max-w-[92%] mx-auto px-4 sm:px-6">
        <!-- Section Header -->
        <div class="max-w-3xl mx-auto text-center mb-16 md:mb-24" data-aos="fade-up">
            <span class="inline-block text-lhm-blue font-bold tracking-widest text-xs uppercase bg-blue-50 px-4 py-1.5 rounded-full mb-4">
                Our Impact
            </span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-lhm-teal">
                Transformative Programs
            </h2>
            <div class="w-12 h-1 bg-lhm-teal mx-auto mt-6 rounded-full"></div>
        </div>

        <!-- Programs Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
            
            <!-- Card 1: Language & Literacy -->
            <div class="group relative flex flex-col justify-between bg-white p-8 md:p-10 rounded-[2rem] border border-gray-100 shadow-md hover:shadow-xl hover:border-lhm-teal/20 transition-all duration-300" data-aos="fade-up">
                <div>
                    <div class="w-14 h-14 bg-teal-50 text-lhm-teal rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:-translate-y-1 transition-transform duration-300">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-lhm-teal transition-colors">Language & Literacy</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">Advancing literacy and digital corpus development for African languages.</p>
                </div>
                <a href="programs.php#language-development-literacy" class="inline-flex items-center gap-2 text-lhm-blue font-bold text-sm group/btn w-fit mt-auto">
                    <span>Learn More</span>
                    <i class="fas fa-arrow-right text-xs transform group-hover/btn:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Card 2: Education & Child Dev -->
            <div class="group relative flex flex-col justify-between bg-white p-8 md:p-10 rounded-[2rem] border border-gray-100 shadow-md hover:shadow-xl hover:border-lhm-teal/20 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                <div>
                    <div class="w-14 h-14 bg-teal-50 text-lhm-teal rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:-translate-y-1 transition-transform duration-300">
                        <i class="fas fa-school"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-lhm-teal transition-colors">Education & Child Dev</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">Child protection, inclusive education, and leadership training for youth.</p>
                </div>
                <a href="programs.php#education-child-development" class="inline-flex items-center gap-2 text-lhm-blue font-bold text-sm group/btn w-fit mt-auto">
                    <span>Learn More</span>
                    <i class="fas fa-arrow-right text-xs transform group-hover/btn:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Card 3: Emergency Response -->
            <div class="group relative flex flex-col justify-between bg-white p-8 md:p-10 rounded-[2rem] border border-gray-100 shadow-md hover:shadow-xl hover:border-lhm-teal/20 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                <div>
                    <div class="w-14 h-14 bg-teal-50 text-lhm-teal rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:-translate-y-1 transition-transform duration-300">
                        <i class="fas fa-truck-medical"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-lhm-teal transition-colors">Emergency Response</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">Restoring dignity and building resilience through rapid relief efforts.</p>
                </div>
                <a href="programs.php#emergency-disaster-response" class="inline-flex items-center gap-2 text-lhm-blue font-bold text-sm group/btn w-fit mt-auto">
                    <span>Learn More</span>
                    <i class="fas fa-arrow-right text-xs transform group-hover/btn:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Card 4: Livelihoods & Resilience -->
            <div class="group relative flex flex-col justify-between bg-white p-8 md:p-10 rounded-[2rem] border border-gray-100 shadow-md hover:shadow-xl hover:border-lhm-teal/20 transition-all duration-300" data-aos="fade-up">
                <div>
                    <div class="w-14 h-14 bg-teal-50 text-lhm-teal rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:-translate-y-1 transition-transform duration-300">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-lhm-teal transition-colors">Livelihoods & Resilience</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">Vocational training and climate-smart agriculture for economic dignity.</p>
                </div>
                <a href="programs.php#livelihoods-economic-resilience" class="inline-flex items-center gap-2 text-lhm-blue font-bold text-sm group/btn w-fit mt-auto">
                    <span>Learn More</span>
                    <i class="fas fa-arrow-right text-xs transform group-hover/btn:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Card 5: Health & WASH -->
            <div class="group relative flex flex-col justify-between bg-white p-8 md:p-10 rounded-[2rem] border border-gray-100 shadow-md hover:shadow-xl hover:border-lhm-teal/20 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                <div>
                    <div class="w-14 h-14 bg-teal-50 text-lhm-teal rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:-translate-y-1 transition-transform duration-300">
                        <i class="fas fa-faucet-drip"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-lhm-teal transition-colors">Health & WASH</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">Healthcare and sanitation initiatives ensuring community health and dignity.</p>
                </div>
                <a href="programs.php#health-nutrition-wash" class="inline-flex items-center gap-2 text-lhm-blue font-bold text-sm group/btn w-fit mt-auto">
                    <span>Learn More</span>
                    <i class="fas fa-arrow-right text-xs transform group-hover/btn:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Card 6: Faith & Public Engagement -->
            <div class="group relative flex flex-col justify-between bg-white p-8 md:p-10 rounded-[2rem] border border-gray-100 shadow-md hover:shadow-xl hover:border-lhm-teal/20 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                <div>
                    <div class="w-14 h-14 bg-teal-50 text-lhm-teal rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:-translate-y-1 transition-transform duration-300">
                        <i class="fas fa-hands-praying"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-lhm-teal transition-colors">Faith & Engagement</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">Mobilizes faith communities and local leaders for ethical, servant-led transformation.</p>
                </div>
                <a href="programs.php#faith-public-engagement" class="inline-flex items-center gap-2 text-lhm-blue font-bold text-sm group/btn w-fit mt-auto">
                    <span>Learn More</span>
                    <i class="fas fa-arrow-right text-xs transform group-hover/btn:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Card 7: Knowledge & Innovation (Centered cleanly on desktop) -->
          

        </div>
    </div>
</section>

     <section id="donate" class="py-32 bg-lhm-blue relative overflow-hidden mobile-section-padding">
    <div class="absolute inset-0 hero-pattern opacity-10 pointer-events-none"></div>
    <div class="bg-blob bg-white/5 -top-40 -left-40"></div>

    <div class="max-w-[92%] mx-auto px-6 relative z-10">
        
        <div class="text-center mb-24" data-aos="fade-up">
            <span class="text-lhm-blue-light font-bold text-xs uppercase tracking-[0.3em] mb-4 block">Support Our Mission</span>
            <h2 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white leading-tight mb-8">
                Fuel the Transformation</span>
            </h2>
            <p class="text-white/70 max-w-2xl mx-auto font-medium text-lg md:text-xl leading-relaxed">
                Choose a gateway to make a secure contribution. Your support directly empowers community-led development across Africa.
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-10">
            
            <div class="group bg-white rounded-[2.5rem] p-2 shadow-2xl transition-all duration-500 hover:-translate-y-2" data-aos="fade-up">
                <div class="overflow-hidden rounded-[2.2rem] flex flex-col h-full">
                    <div class="h-44 overflow-hidden relative bg-gray-100">
                        <img src="cbe.jpg" alt="Commercial Bank of Ethiopia" class="w-full h-full object-contain transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>
                    
                    <div class="p-8 text-center flex flex-col flex-grow">
                        <h4 class="text-lhm-teal font-bold text-sm uppercase mb-4">Commercial Bank of Ethiopia</h4>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between bg-lhm-gray rounded-2xl p-5 border border-gray-100">
                                <div class="text-left">
                                    <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-1">Dollar Currency</p>
                                    <span class="text-lhm-teal font-mono font-bold text-lg">1000753242035</span>
                                </div>
                                <button onclick="copyToClipboard('1000753242035', this)" class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-lhm-blue shadow-sm hover:bg-lhm-blue  transition-all">
                                    <i class="far fa-copy"></i>
                                </button>
                            </div>
                            <div class="flex items-center justify-between bg-lhm-gray rounded-2xl p-5 border border-gray-100">
                                <div class="text-left">
                                    <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-1">Ethiopian Birr</p>
                                    <span class="text-lhm-teal font-mono font-bold text-lg">1000753242663</span>
                                </div>
                                <button onclick="copyToClipboard('1000753242663', this)" class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-lhm-blue shadow-sm hover:bg-lhm-blue  transition-all">
                                    <i class="far fa-copy"></i>
                                </button>
                            </div>
                        </div>
                        <p class="mt-auto text-[10px] text-gray-400 font-bold uppercase tracking-widest">Swift Code: CBETETAA</p>
                    </div>
                </div>
            </div>

            <div class="group bg-white rounded-[2.5rem] p-2 shadow-2xl transition-all duration-500 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                <div class="overflow-hidden rounded-[2.2rem] flex flex-col h-full">
                    <div class="h-44 overflow-hidden relative bg-gray-100">
                        <img src="awash.jpg" alt="Awash Bank" class="w-full h-full object-contain transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>

                    <div class="p-8 text-center flex flex-col flex-grow">
                        <h4 class="text-lhm-teal font-bold text-sm uppercase mb-4">Awash Bank International</h4>
                         <div class="flex items-center justify-between bg-lhm-gray rounded-2xl p-5 border border-gray-100">
                                <div class="text-left">
                                    <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-1">Dollar Currency</p>
                                    <span class="text-lhm-teal font-mono font-bold text-lg">023071744135701</span>
                                </div>
                                <button onclick="copyToClipboard('023071744135701', this)" class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-lhm-blue shadow-sm hover:bg-lhm-blue  transition-all">
                                    <i class="far fa-copy"></i>
                                </button>
                            </div>
                        <div class="flex items-center justify-between bg-lhm-gray rounded-2xl p-5 border border-gray-100">
                                <div class="text-left">
                                    <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-1">Ethiopian Birr</p>
                                    <span class="text-lhm-teal font-mono font-bold text-lg">013081744135700</span>
                                </div>
                                <button onclick="copyToClipboard('013081744135700', this)" class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-lhm-blue shadow-sm hover:bg-lhm-blue  transition-all">
                                    <i class="far fa-copy"></i>
                                </button>
                            </div>
                        <p class="mt-auto text-[10px] text-gray-400 font-bold uppercase tracking-widest">SWIFTT CODE: AWINETAA</p>
                    </div>
                </div>
            </div>

            <div class="group bg-white rounded-[2.5rem] p-2 shadow-2xl transition-all duration-500 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                <div class="overflow-hidden rounded-[2.2rem] flex flex-col h-full">
                    <div class="h-44 overflow-hidden relative bg-gray-100">
                        <img src="sinqee.png" alt="Siinqee Bank" class="w-full h-full object-contain transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>
                    
                    <div class="p-8 text-center flex flex-col flex-grow">
                        <h4 class="text-lhm-teal font-bold text-sm uppercase mb-4">Siinqee Bank</h4>
                        <div class="flex items-center justify-between bg-lhm-gray rounded-2xl p-5 border border-gray-100">
                                <div class="text-left">
                                    <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-1">Dollar Currency</p>
                                    <span class="text-lhm-teal font-mono font-bold text-lg">2110514011215</span>
                                </div>
                                <button onclick="copyToClipboard('2110514011215', this)" class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-lhm-blue shadow-sm hover:bg-lhm-blue  transition-all">
                                    <i class="far fa-copy"></i>
                                </button>
                            </div>
                         <div class="flex items-center justify-between bg-lhm-gray rounded-2xl p-5 border border-gray-100">
                                <div class="text-left">
                                    <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-1">Ethiopian Birr</p>
                                    <span class="text-lhm-teal font-mono font-bold text-lg">1110514011218</span>
                                </div>
                                <button onclick="copyToClipboard('1110514011218', this)" class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-lhm-blue shadow-sm hover:bg-lhm-blue  transition-all">
                                    <i class="far fa-copy"></i>
                                </button>
                            </div>

                        <p class="mt-auto text-[10px] text-gray-400 font-bold uppercase tracking-widest">SWIFTT CODE: SINQETAA</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-20 flex justify-center" data-aos="fade-up">
            <div class="inline-flex items-center gap-6 px-8 py-4 rounded-full bg-white/10 border border-white/20 backdrop-blur-md">
                <div class="flex items-center gap-2">
                    <i class="fas fa-shield-check text-lhm-blue-light"></i>
                    <span class="text-[10px] text-white font-bold uppercase tracking-widest">Verified Accounts</span>
                </div>
                <div class="w-px h-4 bg-white/20"></div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-lock text-lhm-blue-light"></i>
                    <span class="text-[10px] text-white font-bold uppercase tracking-widest">Secure Transfer</span>
                </div>
            </div>
        </div>
    </div>
</section>

    <section id="contact" class="py-32 bg-lhm-teal relative overflow-hidden mobile-section-padding">
        <div class="bg-blob blob-blue -bottom-40 -right-40 opacity-20"></div>
        <div class="max-w-[92%] mx-auto px-6 grid lg:grid-cols-2 gap-20 items-center relative z-10">
            <div class="text-white" data-aos="fade-right">
                <p class="text-lhm-blue-light font-bold-title uppercase tracking-[0.3em] text-xs mb-4">Connect With Us</p>
                <h2 class="text-4xl md:text-5xl font-bold-title mb-8">Shape the Future <br>With Us</h2>
                <p class="text-lg text-white/70 mb-12 leading-relaxed max-w-md font-medium">
                    Legacy Holistic Mission thrives on partnership. Join us in creating sustainable, community-owned development.
                </p>
                <div class="space-y-6">
                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-lhm-blue-light text-xl border border-white/10">
                            <i class="fas fa-check"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Transparent Operations</h4>
                            <p class="text-white/50 text-sm">Accountable and open in all our missions.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-lhm-blue-light text-xl border border-white/10">
                            <i class="fas fa-check"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Inclusive Solutions</h4>
                            <p class="text-white/50 text-sm">Locally grounded and community-driven.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-12 rounded-[3.5rem] shadow-2xl relative" data-aos="fade-left">
                <form class="space-y-6" id="contactForm">
                    <h4 class="text-lhm-teal font-bold-title text-2xl mb-8">Get In Touch</h4>
                    <div class="grid md:grid-cols-2 gap-6">
                        <input type="text" id="firstName" placeholder="First Name" required class="w-full bg-lhm-gray border border-gray-100 rounded-2xl p-5 focus:ring-2 focus:ring-lhm-blue outline-none transition font-medium">
                        <input type="text" id="lastName" placeholder="Last Name" required class="w-full bg-lhm-gray border border-gray-100 rounded-2xl p-5 focus:ring-2 focus:ring-lhm-blue outline-none transition font-medium">
                    </div>
                    <input type="email" id="email" placeholder="Email Address" required class="w-full bg-lhm-gray border border-gray-100 rounded-2xl p-5 focus:ring-2 focus:ring-lhm-blue outline-none transition font-medium">
                    <textarea rows="4" id="message" placeholder="How can we help?" required class="w-full bg-lhm-gray border border-gray-100 rounded-2xl p-5 focus:ring-2 focus:ring-lhm-blue outline-none transition font-medium"></textarea>
                    <button type="submit" class="w-full bg-lhm-teal text-white py-5 rounded-2xl font-bold hover:bg-lhm-blue transition shadow-xl uppercase tracking-widest text-sm btn-bold">Send Message</button>
                </form>
            </div>
        </div>
    </section>
<?php
$content = ob_get_clean();
render_layout('Legacy Holistic Mission', $content);
?>
