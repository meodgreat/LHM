<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Programs | Legacy Holistic Mission</title>
        <link rel="icon" type="image/x-icon" href="lhm.png">
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            :root {
                --lhm-teal: #083d47;
                --lhm-blue: #3a8fab;
                --lhm-blue-light: #7eb8d4;
                --lhm-gray: #f9fafb;
            }

            body {
                font-family: 'Comfortaa', cursive;
                background-color: #fdfdfd;
                color: #4b5563;
                scroll-behavior: smooth;
            }

            /* --- Modern Hero --- */
            .hero-programs {
                background: linear-gradient(rgba(8, 61, 71, 0.85), rgba(8, 61, 71, 0.85)), url('pexels-safari-consoler-3290243-11834966.jpg');
                background-size: cover;
                background-position: center;
                padding: 160px 0 100px;
                clip-path: polygon(0 0, 100% 0, 100% 90%, 0% 100%);
            }

            /* --- Program Card Redesign --- */
            .program-card-modern {
                background: white;
                border: 1px solid rgba(0,0,0,0.03);
                transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
                position: relative;
                overflow: hidden;
            }

            .program-card-modern:hover {
                transform: translateY(-10px);
                box-shadow: 0 40px 60px -15px rgba(8, 61, 71, 0.1);
                border-color: var(--lhm-blue-light);
            }

            .icon-box-modern {
                width: 70px;
                height: 70px;
                background: var(--lhm-gray);
                border-radius: 18px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.75rem;
                color: var(--lhm-blue);
                transition: all 0.3s ease;
            }

            .program-card-modern:hover .icon-box-modern {
                background: var(--lhm-blue);
                color: white;
                transform: scale(1.1) rotate(5deg);
            }

            .feature-badge {
                font-size: 0.65rem;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                font-weight: 800;
                color: var(--lhm-blue);
                background: rgba(58, 143, 171, 0.08);
                padding: 4px 12px;
                border-radius: 99px;
                margin-bottom: 1.25rem;
                display: inline-block;
            }

            .check-item {
                display: flex;
                align-items: flex-start;
                gap: 10px;
                font-size: 0.85rem;
                color: #6b7280;
                margin-bottom: 8px;
            }

            .check-item i {
                margin-top: 3px;
                color: var(--lhm-blue-light);
            }

            .impact-strip {
                margin-top: 2rem;
                padding-top: 1.5rem;
                border-top: 1px dashed #e5e7eb;
            }
 /* --- Navigation --- */
            .nav-link { position: relative; }
            .nav-link::after {
                content: ''; position: absolute; width: 0; height: 2px;
                bottom: -4px; left: 0; background-color: var(--lhm-blue);
                transition: width 0.3s ease;
            }
            .nav-link:hover::after { width: 100%; }
            
            .bg-lhm-teal { background-color: var(--lhm-teal); }
            .bg-lhm-blue { background-color: var(--lhm-blue); }
            .text-lhm-teal { color: var(--lhm-teal); }
            .text-lhm-blue { color: var(--lhm-blue); }
            .text-lhm-blue-light { color: var(--lhm-blue-light); }

            /* Bolder Elements */
            .font-bold-title { font-weight: 800; }
            .btn-bold {
                box-shadow: 0 4px 0px 0px rgba(0,0,0,0.15);
                transition: all 0.2s ease;
            }
            .btn-bold:active {
                transform: translateY(2px);
                box-shadow: 0 2px 0px 0px rgba(0,0,0,0.1);
            }
            @keyframes cardTwick {
                0%, 100% {
                    transform: translateX(0);
                }
                15% {
                    transform: translateX(-5px);
                }
                30% {
                    transform: translateX(5px);
                }
                45% {
                    transform: translateX(-4px);
                }
                60% {
                    transform: translateX(4px);
                }
                75% {
                    transform: translateX(-2px);
                }
                90% {
                    transform: translateX(2px);
                }
            }
            .program-card-twick {
                animation: cardTwick 0.65s ease-in-out 3;
                box-shadow: 0 0 0 3px rgba(58, 143, 171, 0.28), 0 40px 60px -15px rgba(8, 61, 71, 0.12);
                border-color: var(--lhm-blue-light);
            }
            .mobile-nav-menu {
                display: none;
            }
            .mobile-nav-menu.open {
                display: block;
            }
            @media (max-width: 767px) {
                .mobile-donate-hide {
                    display: none;
                }
                .hero-programs {
                    padding: 130px 0 80px;
                }
            }
        </style>
    </head>
    <body>

       <nav class="fixed w-full z-50 bg-white/95 backdrop-blur-md shadow-md border-b border-gray-100 transition-all duration-300">
        <div class="max-w-[92%] mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#home" class="flex items-center gap-3">
                <img src="lhm.png" alt="LHM Logo" class="h-10 w-auto object-contain">
                <span class="font-bold text-lhm-teal text-xl tracking-tighter hidden md:inline">Legacy Holistic Mission</span>
                <span class="font-bold text-lhm-teal text-xl tracking-tighter md:hidden">LHM</span>
            </a>
            <div class="hidden md:flex gap-10 font-bold text-sm items-center">
                <a href="index.php" class=" font-bold text-lhm-teal hover:text-lhm-teal transition nav-link">Home</a>
                <a href="about.php" class="text-lhm-teal hover:text-lhm-teal transition nav-link">About</a>
                <div class="relative group">
                    <a href="programs.php" class="text-lhm-teal hover:text-lhm-teal transition nav-link inline-flex items-center gap-2">Programs <i class="fas fa-caret-down text-xs"></i></a>
                    <div class="absolute left-0 mt-2 w-72 bg-white rounded-lg shadow-lg p-2 hidden group-hover:block z-50">
                        <a href="programs.php#language-development-literacy" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Language Development & Literacy</a>
                        <a href="programs.php#education-child-development" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Education & Child Development</a>
                        <a href="programs.php#emergency-disaster-response" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Emergency & Disaster Response</a>
                        <a href="programs.php#livelihoods-economic-resilience" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Livelihoods & Economic Resilience</a>
                        <a href="programs.php#health-nutrition-wash" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Health, Nutrition & WASH</a>
                        <a href="programs.php#faith-public-engagement" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Faith & Public Engagement</a>
                        <a href="programs.php#knowledge-innovation" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Knowledge & Innovation</a>
                    </div>
                </div>
                <a href="blog.php" class="text-lhm-teal hover:text-lhm-teal transition nav-link">News and Blogs</a>
            </div>
            <div class="flex items-center gap-3">
                <a href="index.php#donate" class="mobile-donate-hide bg-lhm-blue text-white px-7 py-2.5 rounded-full text-sm font-bold hover:bg-lhm-teal transition-all shadow-lg hover:shadow-xl btn-bold">Donate</a>
                <button id="mobileNavToggle" class="md:hidden text-lhm-teal text-xl" aria-label="Toggle menu" aria-expanded="false" aria-controls="mobileNavMenu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        <div id="mobileNavMenu" class="mobile-nav-menu md:hidden border-t border-gray-100 bg-white/95 backdrop-blur-md">
            <div class="px-6 py-4 flex flex-col gap-4 font-bold text-sm">
                <a href="index.php" class="text-lhm-teal">Home</a>
                <a href="about.php" class="text-lhm-teal">About</a>
                <a href="programs.php" class="text-lhm-teal">Programs</a>
                <a href="blog.php" class="text-lhm-teal">News and Blogs</a>
                <a href="index.php#donate" class="bg-lhm-blue text-white px-5 py-2.5 rounded-full text-center">Donate</a>
            </div>
        </div>
    </nav>

        <header class="hero-programs text-center text-white">
            <div class="max-w-4xl mx-auto px-6" data-aos="zoom-out">
                <h1 class="text-5xl md:text-7xl font-bold mb-6">Our Programs</h1>
                <p class="text-white/80 text-lg md:text-xl font-light max-w-2xl mx-auto">
                    Holistic programs that journey with people from crisis to thriving.
                </p>
            </div>
        </header>

        <main class="py-24">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
 <div class="program-card-modern p-10 rounded-[2.5rem]" id="language-development-literacy" data-aos="fade-up">
                        <span class="feature-badge">Preservation</span>
                        <div class="icon-box-modern mb-8"><i class="fas fa-book-open"></i></div>
                        <h2 id="language-development-literacy" class="text-2xl font-bold text-lhm-teal mb-4">Language Development & Literacy</h2>
                        <p class="text-sm text-gray-500 mb-6 leading-relaxed">Strengthens vernacular languages and literacy for all ages, preserving linguistic identity. We make literacy accessible in the languages they know best.</p>
                        <div class="space-y-2">
                            <div class="check-item"><i class="fas fa-check-circle"></i> Orthography & Lexicography</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Functional Literacy Programs</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Mother Tongue Teacher Training</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Digital Corpus Development</div>
                        </div>
                        <div class="impact-strip">
                            <p class="text-[10px] font-black uppercase text-lhm-blue tracking-widest">Impact: Preserves linguistic identity & transformation</p>
                        </div>
                    </div>

                    <div class="program-card-modern p-10 rounded-[2.5rem]" id="education-child-development1" data-aos="fade-up" data-aos-delay="100">
                        <span class="feature-badge">Foundation</span>
                        <div class="icon-box-modern mb-8"><i class="fas fa-graduation-cap"></i></div>
                        <h2 id="education-child-development" class="text-2xl font-bold text-lhm-teal mb-4">Education & Child Development</h2>
                        <p class="text-sm text-gray-500 mb-6 leading-relaxed">Comprehensive child protection and inclusive education programs to build human capital, ensuring every child has the opportunity to thrive.</p>
                        <div class="space-y-2">
                            <div class="check-item"><i class="fas fa-check-circle"></i> Early Childhood & Parenting</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Child Protection & Transition Homes</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Inclusive & Special Education</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Youth Leadership Training</div>
                        </div>
                        <div class="impact-strip">
                            <p class="text-[10px] font-black uppercase text-lhm-blue tracking-widest">Impact: Protects children & creates pathways</p>
                        </div>
                    </div>
                <div class="program-card-modern p-10 rounded-[2.5rem] border-red-50" id="emergency-disaster-response1" data-aos="fade-up" data-aos-delay="200">
                        <span class="feature-badge !bg-red-50 ">Humanitarian</span>
                        <div class="icon-box-modern mb-8 "><i class="fas fa-hand-holding-medical"></i></div>
                        <h2 id="emergency-disaster-response" class="text-2xl font-bold text-lhm-teal mb-4">Emergency & Disaster Response</h2>
                        <p class="text-sm text-gray-500 mb-6 leading-relaxed">Rapid humanitarian response and long-term resilience building in crisis. We ensure aid reaches those most in need while restoring dignity.</p>
                        <div class="space-y-2">
                            <div class="check-item"><i class="fas fa-check-circle "></i> Disaster Preparedness</div>
                            <div class="check-item"><i class="fas fa-check-circle "></i> Food & Healthcare Relief</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Climate-Resilient Recovery</div>
                            <div class="check-item"><i class="fas fa-check-circle "></i> Humanitarian Coordination</div>
                        </div>
                        <div class="impact-strip">
                            <p class="text-[10px] font-black uppercase  tracking-widest">Impact: Saves lives & restores dignity</p>
                        </div>
                    </div>

                    <div class="program-card-modern p-10 rounded-[2.5rem]" id="livelihoods-economic-resilience1" data-aos="fade-up">
                        <span class="feature-badge">Growth</span>
                        <div class="icon-box-modern mb-8"><i class="fas fa-wheat-awn"></i></div>
                        <h2 id="livelihoods-economic-resilience" class="text-2xl font-bold text-lhm-teal mb-4">Livelihoods & Economic Resilience</h2>
                        <p class="text-sm text-gray-500 mb-6 leading-relaxed">Empowering families through vocational training and financial inclusion, helping communities move beyond survival to sustainable futures.</p>
                        <div class="space-y-2">
                            <div class="check-item"><i class="fas fa-check-circle"></i> Vocational Training</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Financial Savings Groups</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Climate-Smart Agriculture</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Market Access for Women</div>
                        </div>
                        <div class="impact-strip">
                            <p class="text-[10px] font-black uppercase text-lhm-blue tracking-widest">Impact: Families achieve economic dignity</p>
                        </div>
                    </div>
 <div class="program-card-modern p-10 rounded-[2.5rem]" id="health-nutrition-wash1" data-aos="fade-up" data-aos-delay="100">
                        <span class="feature-badge">Well-being</span>
                        <div class="icon-box-modern mb-8"><i class="fas fa-droplet"></i></div>
                        <h2 id="health-nutrition-wash" class="text-2xl font-bold text-lhm-teal mb-4">Health, Nutrition & WASH</h2>
                        <p class="text-sm text-gray-500 mb-6 leading-relaxed">Strengthens primary healthcare and water/sanitation systems, providing the foundation for a healthy, dignified community life.</p>
                        <div class="space-y-2">
                            <div class="check-item"><i class="fas fa-check-circle"></i> Community Health Workers</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Maternal & Child Health</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> WASH Promotion</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Psychosocial Support</div>
                        </div>
                        <div class="impact-strip">
                            <p class="text-[10px] font-black uppercase text-lhm-blue tracking-widest">Impact: Improved health & resilience</p>
                        </div>
                    </div>

                    <div class="program-card-modern p-10 rounded-[2.5rem]" id="faith-public-engagement1" data-aos="fade-up" data-aos-delay="200">
                        <span class="feature-badge">Servanthood</span>
                        <div class="icon-box-modern mb-8"><i class="fas fa-hands-praying"></i></div>
                        <h2 id="faith-public-engagement" class="text-2xl font-bold text-lhm-teal mb-4">Faith & Public Engagement</h2>
                        <p class="text-sm text-gray-500 mb-6 leading-relaxed">Mobilizes faith communities and local leaders for ethical, servant-led transformation and policy engagement for equity.</p>
                        <div class="space-y-2">
                            <div class="check-item"><i class="fas fa-check-circle"></i> Servant Leadership Training</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Civic Engagement</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Institutional Localization</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Advocacy for Justice</div>
                        </div>
                        <div class="impact-strip">
                            <p class="text-[10px] font-black uppercase text-lhm-blue tracking-widest">Impact: Locally led development</p>
                        </div>
                    </div>
 <div class="program-card-modern p-10 rounded-[2.5rem]" id="knowledge-innovation1" data-aos="fade-up">
                        <span class="feature-badge">Intelligence</span>
                        <div class="icon-box-modern mb-8"><i class="fas fa-lightbulb"></i></div>
                        <h2 id="knowledge-innovation" class="text-2xl font-bold text-lhm-teal mb-4">Knowledge & Innovation</h2>
                        <p class="text-sm text-gray-500 mb-6 leading-relaxed">Ensures adaptive, evidence-based development through research, MEAL systems, and digital innovation to continuously improve our impact.</p>
                        <div class="space-y-2">
                            <div class="check-item"><i class="fas fa-check-circle"></i> Impact Evaluation & MEAL</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Digital Innovation</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Gender & Climate Resilience</div>
                            <div class="check-item"><i class="fas fa-check-circle"></i> Sustainability Systems</div>
                        </div>
                        <div class="impact-strip">
                            <p class="text-[10px] font-black uppercase text-lhm-blue tracking-widest">Impact: Evidence-based development</p>
                        </div>
                    </div>

                </div>
            </div>
        </main>

      <footer class="py-20 bg-white text-center border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col items-center mb-12">
                <img src="lhm.png" alt="LHM Logo" class="h-14 w-auto object-contain mb-6">
                <h3 class="text-lhm-teal font-bold-title text-2xl mb-2">Legacy Holistic Mission</h3>
                <p class="text-gray-400 font-medium italic text-sm">"Serving the Whole Person, Empowering Every Community, Lasting Impact"</p>
            </div>
            
            <div class="flex flex-wrap justify-center gap-10 mb-12">
                <a href="index.php" class="text-gray-600 hover:text-lhm-blue transition text-sm font-bold tracking-widest uppercase">Home</a>
                <a href="about.php" class="text-gray-600 hover:text-lhm-blue transition text-sm font-bold tracking-widest uppercase">About</a>
                <a href="programs.php" class="text-gray-600 hover:text-lhm-blue transition text-sm font-bold tracking-widest uppercase">Programs</a>
                <a href="index.php#donate" class="text-gray-600 hover:text-lhm-blue transition text-sm font-bold tracking-widest uppercase">Donate</a>
                <a href="index.php#contact" class="text-gray-600 hover:text-lhm-blue transition text-sm font-bold tracking-widest uppercase">Contact</a>
                <a href="about.php#ourteam" class="text-gray-600 hover:text-lhm-blue transition text-sm font-bold tracking-widest uppercase">Our-Team</a>
            </div>

            <div class="flex justify-center gap-8 mb-12">
                <a href="https://et.linkedin.com/company/legacy-holistic-mission-lhm" class="w-12 h-12 bg-lhm-gray rounded-full flex items-center justify-center text-gray-400 hover:bg-[#0077B5] hover:text-white transition-all duration-300"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://web.facebook.com/people/Legacy-Holistic-Mission/61586454209081/#" class="w-12 h-12 bg-lhm-gray rounded-full flex items-center justify-center text-gray-400 hover:bg-[#1877F2] hover:text-white transition-all duration-300"><i class="fab fa-facebook-f"></i></a>
            </div>

            <div class="text-gray-300 text-[10px] font-bold uppercase tracking-[0.4em]">
                &copy; 2026 Legacy Holistic Mission. All Rights Reserved.
            </div>
        </div>
    </footer>

        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init({ duration: 900, once: true });
            const mobileNavToggle = document.getElementById('mobileNavToggle');
            const mobileNavMenu = document.getElementById('mobileNavMenu');
            if (mobileNavToggle && mobileNavMenu) {
                mobileNavToggle.addEventListener('click', () => {
                    const isOpen = mobileNavMenu.classList.toggle('open');
                    mobileNavToggle.setAttribute('aria-expanded', String(isOpen));
                    mobileNavToggle.innerHTML = isOpen ? '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
                });
                mobileNavMenu.querySelectorAll('a').forEach((link) => {
                    link.addEventListener('click', () => {
                        mobileNavMenu.classList.remove('open');
                        mobileNavToggle.setAttribute('aria-expanded', 'false');
                        mobileNavToggle.innerHTML = '<i class="fas fa-bars"></i>';
                    });
                });
            }

            function twickTargetCardFromHash() {
                if (!window.location.hash) return;
                const hashId = window.location.hash.slice(1);
                const target = document.getElementById(hashId);
                if (!target) return;

                const card = target.classList.contains('program-card-modern')
                    ? target
                    : target.closest('.program-card-modern');
                if (!card) return;

                card.classList.remove('program-card-twick');
                void card.offsetWidth;
                card.classList.add('program-card-twick');

                setTimeout(() => {
                    card.classList.remove('program-card-twick');
                }, 2100);
            }

            window.addEventListener('DOMContentLoaded', twickTargetCardFromHash);
            window.addEventListener('hashchange', twickTargetCardFromHash);
        </script>
    </body>
    </html>