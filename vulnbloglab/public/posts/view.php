<?php
session_start();
require_once('../../includes/db.php');

$post_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($post_id <= 0) {
    die("❌ ID bài viết không hợp lệ.");
}

$sql = "SELECT * FROM posts WHERE id = $post_id";
$result = mysqli_query($conn, $sql);
$post = mysqli_fetch_assoc($result);

if (!$post) {
    die("❌ Không tìm thấy bài viết.");
}

$comments = mysqli_query($conn, "SELECT * FROM comments WHERE post_id = $post_id ORDER BY created_at DESC");
?>

<?php include('../header.php'); ?>
<main class="max-w-3xl mx-auto mt-12 p-6 bg-white dark:bg-gray-800 rounded">
  <h1 class="text-3xl font-bold mb-4"><?= htmlspecialchars($post['title']) ?></h1>
  <div class="prose dark:prose-invert max-w-none mb-6">
    <?= $post['content'] ?>
  </div>


  <h2 class="text-xl font-semibold mb-2">💬 Bình luận</h2>
  <form method="POST" action="comment.php" class="space-y-3 mb-6">
    <input type="hidden" name="post_id" value="<?= $post_id ?>">
    <input name="author" placeholder="Tên của bạn" class="w-full border p-2 rounded dark:bg-gray-700" />
    <textarea name="content" placeholder="Nội dung..." class="w-full border p-2 rounded dark:bg-gray-700"></textarea>
    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Gửi</button>
  </form>

  <?php while ($c = mysqli_fetch_assoc($comments)): ?>
    <div class="mb-4 p-3 rounded bg-gray-100 dark:bg-gray-700">
      <p class="text-sm font-semibold"><?= htmlspecialchars($c['author']) ?> <span
          class="text-xs text-gray-500"><?= $c['created_at'] ?></span></p>
      <p class="text-gray-800 dark:text-gray-100"><?= $c['content'] ?></p>
    </div>
  <?php endwhile; ?>
</main>
<?php include('../footer.php'); ?>