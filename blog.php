<?php
require_once 'db.php';
require_once 'header-footer.php';

// Fetch rows ordered chronologically
$stmt = $pdo->query('SELECT * FROM blog_posts ORDER BY created_at DESC');
$posts = $stmt->fetchAll();

ob_start();
?>

<section class="py-16 relative bg-lhm-gray hero-pattern min-h-screen mt-16 md:mt-20">
    <div class="max-w-[92%] mx-auto px-6">
        
        <div class="text-center mb-16" data-aos="fade-up">
            <p class="text-lhm-blue font-bold-title uppercase tracking-widest text-sm mb-3">Our Field Updates</p>
            <h2 class="text-4xl md:text-5xl font-bold-title text-lhm-teal mb-4">News & Stories</h2>
            <p class="max-w-xl mx-auto text-gray-500 font-medium text-sm">
                Follow real-time progress assessments, holistic transformations, and emergency relief updates direct from our working sectors across Africa.
            </p>
        </div>

        <?php if (empty($posts)): ?>
            <div class="text-center py-20 bg-white rounded-[2.5rem] shadow-sm max-w-lg mx-auto border border-gray-100">
                <i class="fas fa-newspaper text-gray-300 text-5xl mb-4"></i>
                <p class="text-gray-500 font-bold">No announcements published yet.</p>
                <p class="text-gray-400 text-xs mt-1">Check back soon for fresh updates from our field missions.</p>
            </div>
        <?php else: ?>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($posts as $post): ?>
                    <article class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col border border-gray-100 group" data-aos="fade-up">
                        <div class="h-56 overflow-hidden relative bg-gray-100">
                            <img src="uploads/<?php echo htmlspecialchars($post['featured_image']); ?>" 
                                 alt="<?php echo htmlspecialchars($post['title']); ?>" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <span class="absolute top-4 left-4 bg-lhm-teal text-white font-bold text-[10px] uppercase tracking-wider px-4 py-1.5 rounded-full shadow-sm">
                                <?php echo htmlspecialchars($post['category']); ?>
                            </span>
                        </div>
                        
                        <div class="p-8 flex flex-col flex-grow">
                            <time class="text-[11px] text-gray-400 font-bold uppercase tracking-wider mb-3 block">
                                <i class="far fa-calendar-alt mr-1"></i> <?php echo date('M d, Y', strtotime($post['created_at'])); ?>
                            </time>
                            <h3 class="text-xl font-bold text-lhm-teal mb-3 line-clamp-2 group-hover:text-lhm-blue transition-colors">
                                <?php echo htmlspecialchars($post['title']); ?>
                            </h3>
                            <p class="text-gray-500 text-xs leading-relaxed mb-6 line-clamp-3">
                                <?php echo htmlspecialchars($post['summary']); ?>
                            </p>
                            <a href="post.php?slug=<?php echo htmlspecialchars($post['slug']); ?>" 
                               class="mt-auto text-lhm-blue font-bold text-xs inline-flex items-center gap-2 group-hover:gap-4 transition-all">
                                Read Full Story <i class="fas fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php
$content = ob_get_clean();
render_layout("News & Updates", $content);
?>