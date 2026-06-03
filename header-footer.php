<?php
function render_layout($title, $content, $is_admin = false) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?> | Legacy Holistic Mission</title>
    <link rel="icon" type="image/x-icon" href="lhm.png">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --lhm-teal: #083d47;
            --lhm-blue: #3a8fab;
            --lhm-teal-light: #0d5c6b;
            --lhm-blue-light: #7eb8d4;
            --lhm-gray: #f9fafb;
            --lhm-white: #ffffff;
            --lhm-card-bg: #f1f6f7;
        }
        body {
            font-family: 'Comfortaa', cursive;
            scroll-behavior: smooth;
            background-color: var(--lhm-white);
        }
        .bg-lhm-teal { background-color: var(--lhm-teal); }
        .text-lhm-teal { color: var(--lhm-teal); }
        .bg-lhm-blue { background-color: var(--lhm-blue); }
        .text-lhm-blue { color: var(--lhm-blue); }
        .bg-lhm-gray { background-color: var(--lhm-gray); }
        .font-bold-title { font-weight: 800; }
        .hero-pattern {
            background-image: radial-gradient(rgba(122, 184, 212, 0.1) 1px, transparent 1px);
            background-size: 28px 28px;
        }
        
        /* Mobile Menu Styles */
        .mobile-nav-menu {
            display: none;
        }
        .mobile-nav-menu.open {
            display: block;
        }
    </style>
</head>
<body class="text-gray-700 min-h-screen flex flex-col">

    <nav class="fixed w-full z-50 bg-white/95 backdrop-blur-md shadow-md border-b border-gray-100 transition-all duration-300">
        <div class="max-w-[92%] mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#home" class="flex items-center gap-3">
                <img src="lhm.png" alt="LHM Logo" class="h-10 w-auto object-contain">
                <span class="font-bold text-lhm-teal text-xl tracking-tighter hidden md:inline">Legacy Holistic Mission</span>
                <span class="font-bold text-lhm-teal text-xl tracking-tighter md:hidden">LHM</span>
            </a>
            <div class="hidden md:flex gap-10 font-bold text-sm items-center">
                <a href="index.php" class="font-bold text-lhm-teal hover:text-lhm-teal transition nav-link">Home</a>
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
                <a href="index.php#donate" class="hidden md:inline-block bg-lhm-blue text-white px-7 py-2.5 rounded-full text-sm font-bold hover:bg-lhm-teal transition-all shadow-lg hover:shadow-xl btn-bold">Donate</a>
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

    <main class="flex-grow pt-0">
        <?php echo $content; ?>
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
        AOS.init({ duration: 800, once: true });

        // Mobile menu toggle
        const toggle = document.getElementById('mobileNavToggle');
        const menu = document.getElementById('mobileNavMenu');
        
        if (toggle && menu) {
            toggle.addEventListener('click', () => {
                const isOpen = menu.classList.toggle('open');
                toggle.setAttribute('aria-expanded', isOpen);
                
                // Update icon
                toggle.innerHTML = isOpen ? '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
            });
            
            // Close menu when a link is clicked
            menu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    menu.classList.remove('open');
                    toggle.setAttribute('aria-expanded', 'false');
                    toggle.innerHTML = '<i class="fas fa-bars"></i>';
                });
            });
        }

        function copyToClipboard(text, button) {
            navigator.clipboard.writeText(text).then(() => {
                const originalIcon = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i>';
                button.classList.add('text-green-500');
                setTimeout(() => {
                    button.innerHTML = originalIcon;
                    button.classList.remove('text-green-500');
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy:', err);
                alert('Failed to copy to clipboard');
            });
        }
    </script>
</body>
</html>
<?php
}
?>