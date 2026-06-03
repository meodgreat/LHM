<?php
session_start();
require_once 'db.php';
require_once 'header-footer.php';

if (!isset($_SESSION['admin_logged'])) {
    header('Location: login.php');
    exit;
}

$status_msg = '';
$edit_post = null;

// Load existing post for editing
if (isset($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $stmt = $pdo->prepare('SELECT * FROM blog_posts WHERE id = ?');
    $stmt->execute([$edit_id]);
    $edit_post = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Block Action Execution: Create or Update Entry
if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['create_post']) || isset($_POST['edit_post']))) {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $summary = trim($_POST['summary']);
    $content = trim($_POST['content']);
    
    // Auto-create standard URL strings
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
    
    // File Handler Matrix Execution (support multiple images)
    $target_dir = "uploads/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $uploaded_files = [];
    if (!empty($_FILES['featured_images']) && is_array($_FILES['featured_images']['name'])) {
        foreach ($_FILES['featured_images']['name'] as $i => $orig_name) {
            if (empty($orig_name)) continue;
            $tmp_name = $_FILES['featured_images']['tmp_name'][$i];
            $file_ext = pathinfo($orig_name, PATHINFO_EXTENSION);
            $new_file_name = uniqid('img_', true) . '.' . $file_ext;
            $target_file = $target_dir . $new_file_name;
            if (move_uploaded_file($tmp_name, $target_file)) {
                $uploaded_files[] = $new_file_name;
            }
        }
    }

    $is_edit = isset($_POST['edit_post']) && !empty($_POST['post_id']);
    $gallery_json = null;
    $featured_main = null;

    if ($is_edit) {
        $post_id = (int)$_POST['post_id'];
        $stmt = $pdo->prepare('SELECT featured_image, gallery FROM blog_posts WHERE id = ?');
        $stmt->execute([$post_id]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($uploaded_files)) {
            // Delete old files if the gallery is replaced
            if (!empty($existing['featured_image']) && file_exists("uploads/" . $existing['featured_image'])) {
                @unlink("uploads/" . $existing['featured_image']);
            }
            if (!empty($existing['gallery'])) {
                $old_gallery = json_decode($existing['gallery'], true);
                if (is_array($old_gallery)) {
                    foreach ($old_gallery as $old_img) {
                        if (!empty($old_img) && file_exists("uploads/" . $old_img)) {
                            @unlink("uploads/" . $old_img);
                        }
                    }
                }
            }
            $featured_main = $uploaded_files[0];
            $gallery_json = json_encode($uploaded_files);
        } else {
            $featured_main = $existing['featured_image'];
            $gallery_json = $existing['gallery'];
        }
    } else {
        if (!empty($uploaded_files)) {
            $featured_main = $uploaded_files[0];
            $gallery_json = json_encode($uploaded_files);
        }
    }

    if ($is_edit) {
        if ($featured_main === null) {
            $status_msg = "<div class='bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-xs font-bold'>Please provide existing or new images.</div>";
        } else {
            try {
                $stmt = $pdo->prepare('UPDATE blog_posts SET title = ?, slug = ?, category = ?, summary = ?, content = ?, featured_image = ?, gallery = ? WHERE id = ?');
                $stmt->execute([$title, $slug, $category, $summary, $content, $featured_main, $gallery_json, $post_id]);
                $status_msg = "<div class='bg-green-50 text-green-600 p-4 rounded-xl mb-6 text-xs font-bold'>Post successfully updated.</div>";
                header('Location: admin.php');
                exit;
            } catch (\PDOException $e) {
                $status_msg = "<div class='bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-xs font-bold'>Database update error or slug conflict.</div>";
            }
        }
    } else {
        if (!empty($uploaded_files)) {
            try {
                $stmt = $pdo->prepare('INSERT INTO blog_posts (title, slug, category, summary, content, featured_image, gallery) VALUES (?, ?, ?, ?, ?, ?, ?)');
                $stmt->execute([$title, $slug, $category, $summary, $content, $featured_main, $gallery_json]);
                $status_msg = "<div class='bg-green-50 text-green-600 p-4 rounded-xl mb-6 text-xs font-bold'>Article successfully integrated into database.</div>";
                header('Location: admin.php');
                exit;
            } catch (\PDOException $e) {
                $status_msg = "<div class='bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-xs font-bold'>Database write error or slug token conflict.</div>";
            }
        } else {
            $status_msg = "<div class='bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-xs font-bold'>Failed handling media resource uploads.</div>";
        }
    }
}

// Block Action Execution: Delete Entry
if (isset($_GET['delete'])) {
    $id_to_delete = (int)$_GET['delete'];
    
    // Delete files locally (featured + gallery)
    $stmt = $pdo->prepare('SELECT featured_image, gallery FROM blog_posts WHERE id = ?');
    $stmt->execute([$id_to_delete]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        if (!empty($row['featured_image']) && file_exists("uploads/" . $row['featured_image'])) {
            @unlink("uploads/" . $row['featured_image']);
        }
        if (!empty($row['gallery'])) {
            $imgs = json_decode($row['gallery'], true);
            if (is_array($imgs)) {
                foreach ($imgs as $g) {
                    if (!empty($g) && file_exists("uploads/" . $g)) {
                        @unlink("uploads/" . $g);
                    }
                }
            }
        }
    }

    $stmt = $pdo->prepare('DELETE FROM blog_posts WHERE id = ?');
    $stmt->execute([$id_to_delete]);
    header('Location: admin.php');
    exit;
}

// Read dynamic database logs
$posts = $pdo->query('SELECT id, title, category, created_at FROM blog_posts ORDER BY created_at DESC')->fetchAll();

ob_start();
?>

<section class="py-12 bg-lhm-gray min-h-screen hero-pattern" style="margin-top: 6rem;" >
    <div class="max-w-[92%] mx-auto px-6">
        <div class="flex justify-between items-center mb-12 border-b border-gray-200 pb-6">
            <div>
                <h1 class="text-3xl font-bold-title text-lhm-teal">Management Hub</h1>
                <p class="text-xs font-medium text-gray-400">Welcome back, system operations administrator: <span class="text-lhm-blue font-bold"><?php echo htmlspecialchars($_SESSION['admin_user']); ?></span></p>
            </div>
            <a href="logout.php" class="bg-red-50 text-red-600 border border-red-200 px-5 py-2 rounded-xl font-bold text-xs">Terminate Session</a>
        </div>

        <?php echo $status_msg; ?>

        <div class="grid lg:grid-cols-3 gap-10">
            <div class="lg:col-span-1 bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-lhm-teal mb-6"><i class="fas fa-pen-nib mr-2"></i>Publish New Entry</h3>
                <form action="admin.php" method="POST" enctype="multipart/form-data" class="space-y-5">
                    <?php if ($edit_post): ?>
                        <input type="hidden" name="edit_post" value="1">
                        <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($edit_post['id']); ?>">
                    <?php else: ?>
                        <input type="hidden" name="create_post" value="1">
                    <?php endif; ?>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-2 uppercase">Article Title</label>
                        <input type="text" name="title" required value="<?php echo $edit_post ? htmlspecialchars($edit_post['title']) : ''; ?>" class="w-full bg-lhm-gray border border-gray-100 rounded-xl p-4 text-xs font-medium outline-none focus:ring-2 focus:ring-lhm-blue">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-2 uppercase">Working Sector Division</label>
                        <select name="category" class="w-full bg-lhm-gray border border-gray-100 rounded-xl p-4 text-xs font-bold outline-none text-gray-600">
                            <?php $categories = ['Language & Literacy','Education & Child Dev','Emergency Response','Livelihoods & Resilience','Health & WASH']; ?>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo htmlspecialchars($cat); ?>" <?php echo $edit_post && $edit_post['category'] === $cat ? 'selected' : ''; ?>><?php echo htmlspecialchars($cat); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-2 uppercase">Short Summary Teaser</label>
                        <textarea name="summary" rows="2" required class="w-full bg-lhm-gray border border-gray-100 rounded-xl p-4 text-xs font-medium outline-none focus:ring-2 focus:ring-lhm-blue"><?php echo $edit_post ? htmlspecialchars($edit_post['summary']) : ''; ?></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-2 uppercase">Complete Post Content</label>
                        <textarea name="content" rows="6" required class="w-full bg-lhm-gray border border-gray-100 rounded-xl p-4 text-xs font-medium outline-none focus:ring-2 focus:ring-lhm-blue"><?php echo $edit_post ? htmlspecialchars($edit_post['content']) : ''; ?></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-2 uppercase">Featured Header Image(s)</label>
                        <input type="file" name="featured_images[]" accept="image/*" multiple <?php echo $edit_post ? '' : 'required'; ?> class="w-full text-xs font-medium text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-lhm-blue file:text-white hover:file:bg-lhm-teal">
                        <p class="text-[10px] text-gray-400 mt-2"><?php echo $edit_post ? 'Upload new images to replace existing ones. Leave empty to keep current gallery.' : 'You may upload multiple images; the first will be used as the thumbnail.'; ?></p>
                    </div>
                    <?php if ($edit_post && !empty($edit_post['gallery'])): ?>
                        <?php $current_gallery = json_decode($edit_post['gallery'], true); ?>
                        <?php if (is_array($current_gallery) && count($current_gallery) > 0): ?>
                            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 text-xs text-gray-500">
                                <p class="font-bold mb-2">Current images:</p>
                                <div class="flex flex-wrap gap-2">
                                    <?php foreach ($current_gallery as $image_name): ?>
                                        <span class="px-3 py-1 rounded-full bg-white border border-gray-200"><?php echo htmlspecialchars($image_name); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <button type="submit" class="w-full bg-lhm-blue text-white py-4 rounded-xl text-xs font-bold uppercase tracking-wider shadow-md"><?php echo $edit_post ? 'Update Entry' : 'Publish Entry'; ?></button>
                    <?php if ($edit_post): ?>
                        <a href="admin.php" class="inline-flex justify-center w-full py-3 text-xs font-bold uppercase tracking-wider text-lhm-blue border border-lhm-blue rounded-xl">Cancel Edit</a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="lg:col-span-2 bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-lhm-teal mb-6"><i class="fas fa-list-ol mr-2"></i>Active News Listings Track</h3>
                <?php if(empty($posts)): ?>
                    <p class="text-center py-20 text-gray-400 text-xs font-bold">No active dynamic posts indexing database rows.</p>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-100 text-[10px] text-gray-400 font-bold uppercase tracking-widest">
                                    <th class="pb-4">Article Information Title</th>
                                    <th class="pb-4">Working Category</th>
                                    <th class="pb-4">Timestamp</th>
                                    <th class="pb-4 text-right">Terminal Action Options</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 text-xs font-medium text-gray-600">
                                <?php foreach($posts as $p): ?>
                                    <tr>
                                        <td class="py-4 pr-4 font-bold text-lhm-teal max-w-[200px] truncate"><?php echo htmlspecialchars($p['title']); ?></td>
                                        <td class="py-4"><span class="bg-gray-100 text-gray-600 font-bold px-2.5 py-1 rounded-md text-[10px]"><?php echo htmlspecialchars($p['category']); ?></span></td>
                                        <td class="py-4 text-gray-400"><?php echo date('Y-m-d', strtotime($p['created_at'])); ?></td>
                                        <td class="py-4 text-right space-x-2">
                                            <a href="admin.php?edit=<?php echo $p['id']; ?>" class="text-lhm-blue hover:text-lhm-teal font-bold bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition-colors"><i class="far fa-edit"></i></a>
                                            <a href="admin.php?delete=<?php echo $p['id']; ?>" onclick="return confirm('Confirm processing total row termination removal command?')" class="text-red-500 hover:text-red-700 font-bold bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
render_layout("Control Matrix", $content, true);
?>