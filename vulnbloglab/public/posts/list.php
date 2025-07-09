<?php
session_start();
include('../../includes/db.php');

$posts = mysqli_query($conn, "SELECT * FROM posts ORDER BY id DESC");
?>

<?php include('../header.php'); ?>
<main class="max-w-5xl mx-auto px-6 py-12">
  <h1 class="text-3xl font-bold mb-6">📚 Danh sách bài viết</h1>
  <div class="grid md:grid-cols-2 gap-6">
    <?php while ($p = mysqli_fetch_assoc($posts)): ?>
      <div class="bg-white dark:bg-gray-800 p-4 rounded shadow hover:shadow-lg transition">
        <h2 class="text-xl font-semibold"><?= htmlspecialchars($p['title']) ?></h2>
        <p class="text-gray-500 text-sm"><?= substr(strip_tags($p['content']), 0, 100) ?>...</p>
        <a href="view.php?id=<?= $p['id'] ?>" class="text-blue-500 hover:underline mt-2 inline-block">Xem chi tiết</a>
      </div>
    <?php endwhile; ?>
  </div>
</main>
<?php include('../footer.php'); ?>
