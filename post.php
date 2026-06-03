<?php
require_once 'db.php';
require_once 'header-footer.php';

if (!isset($_GET['slug'])) {
    header('Location: blog.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM blog_posts WHERE slug = ?');
$stmt->execute([$_GET['slug']]);
$post = $stmt->fetch();

if (!$post) {
    header('Location: blog.php');
    exit;
}

ob_start();
?>

<div class="bg-blue border-b border-[var(--lhm-program-card-border)] py-4 md:py-7">
    <div class="max-w-5xl mx-auto px-6 flex items-center justify-between">
        <a href="blog.php" class="inline-flex items-center gap-2 text-xs md:text-sm font-bold uppercase tracking-widest text-white hover:text-[var(--lhm-teal)] transition-colors group">
            <i class="fas fa-arrow-left text-[10px] transform group-hover:-translate-x-0.5 transition-transform"></i>
            <span class="hidden sm:inline">Back to Main</span>
            <span class="sm:hidden">Back</span>
        </a>
        <span class="text-xs font-medium text-gray-400 hidden sm:inline select-none">Reading Dispatches</span>
    </div>
</div>

<?php
// Build images array from gallery JSON (if present) or fallback to featured_image
$images = [];
if (!empty($post['gallery'])) {
    $decoded = json_decode($post['gallery'], true);
    if (is_array($decoded) && count($decoded) > 0) {
        $images = $decoded;
    }
}
if (empty($images) && !empty($post['featured_image'])) {
    $images = [$post['featured_image']];
}

$initialImgSrc = 'uploads/' . htmlspecialchars($images[0] ?? '');
?>

<div class="h-[50vh] md:h-[60vh] w-full bg-slate-950 relative overflow-hidden group border-b border-[var(--lhm-program-card-border)]">
    
    <div class="absolute inset-0 overflow-hidden select-none pointer-events-none z-0">
        <img id="carouselBgImg" src="<?php echo $initialImgSrc; ?>" alt="" class="w-full h-full object-cover scale-110 blur-xl opacity-40 transition-all duration-300">
    </div>

    <div class="absolute inset-0 flex items-center justify-center z-10">
        <img id="carouselImg" src="<?php echo $initialImgSrc; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="w-full h-full object-contain transition-all duration-300">
    </div>
    
    <?php if (count($images) > 1): ?>
        <button id="prevBtn" class="absolute left-6 top-1/2 -translate-y-1/2 w-12 h-12 bg-[var(--lhm-white)] hover:bg-[var(--lhm-teal)] text-[var(--lhm-teal)] hover:text-white rounded-full flex items-center justify-center shadow-lg transition-all z-20 cursor-pointer border border-[var(--lhm-program-card-border)]">
            <i class="fas fa-chevron-left text-sm"></i>
        </button>
        <button id="nextBtn" class="absolute right-6 top-1/2 -translate-y-1/2 w-12 h-12 bg-[var(--lhm-white)] hover:bg-[var(--lhm-teal)] text-[var(--lhm-teal)] hover:text-white rounded-full flex items-center justify-center shadow-lg transition-all z-20 cursor-pointer border border-[var(--lhm-program-card-border)]">
            <i class="fas fa-chevron-right text-sm"></i>
        </button>
        
        <div class="absolute bottom-6 right-6 bg-black/60 text-white backdrop-blur-sm text-[11px] font-bold tracking-wider px-4 py-1.5 rounded-full z-20 select-none">
            <span id="carouselCounter">1</span> / <?php echo count($images); ?> Photos
        </div>
    <?php endif; ?>
</div>

<article class="py-16 bg-[var(--lhm-white)] min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
        
        <div class="border-b border-[var(--lhm-program-card-border)] pb-8 mb-10">
            <span class="inline-block bg-[var(--lhm-card-bg)] text-[var(--lhm-blue)] border border-[var(--lhm-program-card-border)] font-bold text-[10px] uppercase tracking-widest px-4 py-1.5 rounded-full shadow-sm mb-4">
                <?php echo htmlspecialchars($post['category']); ?>
            </span>
            
            <h1 class="text-2xl md:text-4xl font-extrabold text-[var(--lhm-teal)] tracking-tight leading-tight mb-4">
                <?php echo htmlspecialchars($post['title']); ?>
            </h1>
            
            <div class="flex flex-wrap items-center gap-4 text-xs font-medium text-gray-400">
                <span class="flex items-center gap-1.5"><i class="far fa-calendar"></i> <?php echo date('F d, Y', strtotime($post['created_at'])); ?></span>
                <span class="w-1 h-1 bg-[var(--lhm-program-card-border)] rounded-full"></span>
                <span class="flex items-center gap-1.5"><i class="far fa-user"></i> LHM Communications</span>
            </div>
        </div>

        <div class="text-gray-600 text-base md:text-lg font-normal leading-relaxed max-w-3xl space-y-6">
            <?php echo nl2br(htmlspecialchars($post['content'])); ?>
        </div>

    </div>
</article>

<?php if (count($images) > 1): ?>
<script>
    (function() {
        const images = <?php echo json_encode($images); ?>;
        if (!images || images.length < 2) return;
        
        let currentIdx = 0;
        const imgEl = document.getElementById('carouselImg');
        const bgImgEl = document.getElementById('carouselBgImg');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const counterEl = document.getElementById('carouselCounter');
        
        if (!imgEl || !bgImgEl || !prevBtn || !nextBtn || !counterEl) return;
        
        function showImage(index) {
            imgEl.style.opacity = '0.4';
            bgImgEl.style.opacity = '0.1'; // Dims back even further briefly during visual swap
            
            setTimeout(() => {
                currentIdx = ((index % images.length) + images.length) % images.length;
                const newSrc = 'uploads/' + images[currentIdx];
                
                imgEl.src = newSrc;
                bgImgEl.src = newSrc;
                
                counterEl.textContent = currentIdx + 1;
                imgEl.style.opacity = '1';
                bgImgEl.style.opacity = '0.4'; // Restores customized background layout visibility
            }, 150);
        }
        
        prevBtn.addEventListener('click', function(e) {
            e.preventDefault();
            showImage(currentIdx - 1);
        });
        
        nextBtn.addEventListener('click', function(e) {
            e.preventDefault();
            showImage(currentIdx + 1);
        });
    })();
</script>
<?php endif; ?>

<?php
$content = ob_get_clean();
render_layout($post['title'], $content);
?>