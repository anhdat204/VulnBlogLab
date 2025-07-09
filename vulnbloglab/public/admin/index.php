<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/functions.php';

// Không kiểm tra quyền — mô phỏng Privilege Escalation

$users = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
$posts = mysqli_query($conn, "SELECT COUNT(*) as total FROM posts");
$comments = mysqli_query($conn, "SELECT COUNT(*) as total FROM comments");

$user_total = mysqli_fetch_assoc($users)['total'];
$post_total = mysqli_fetch_assoc($posts)['total'];
$comment_total = mysqli_fetch_assoc($comments)['total'];
?>

<?php include '../header.php'; ?>
<main class="max-w-5xl mx-auto mt-12 p-6 bg-white dark:bg-gray-800 rounded shadow">
  <h2 class="text-3xl font-bold mb-6 text-purple-500">📊 Bảng quản trị hệ thống</h2>

  <div class="grid md:grid-cols-3 gap-6 text-center mb-6">
    <div class="bg-purple-100 dark:bg-purple-900 p-6 rounded-lg shadow">
      <div class="text-xl font-bold text-purple-700 dark:text-purple-300">👥 Người dùng</div>
      <div class="text-3xl font-extrabold mt-2 text-purple-800"><?= $user_total ?></div>
    </div>
    <div class="bg-blue-100 dark:bg-blue-900 p-6 rounded-lg shadow">
      <div class="text-xl font-bold text-blue-700 dark:text-blue-300">📝 Bài viết</div>
      <div class="text-3xl font-extrabold mt-2 text-blue-800"><?= $post_total ?></div>
    </div>
    <div class="bg-green-100 dark:bg-green-900 p-6 rounded-lg shadow">
      <div class="text-xl font-bold text-green-700 dark:text-green-300">💬 Bình luận</div>
      <div class="text-3xl font-extrabold mt-2 text-green-800"><?= $comment_total ?></div>
    </div>
  </div>

  <div class="grid md:grid-cols-2 gap-4">
    <a href="/admin/users.php" class="block bg-gray-100 dark:bg-gray-700 p-4 rounded hover:bg-gray-200 transition text-center font-semibold text-purple-600">👑 Quản lý người dùng</a>
    <a href="/admin/logs.php" class="block bg-gray-100 dark:bg-gray-700 p-4 rounded hover:bg-gray-200 transition text-center font-semibold text-indigo-600">📄 Nhật ký AI / Upload</a>
    <a href="/upload.php" class="block bg-gray-100 dark:bg-gray-700 p-4 rounded hover:bg-gray-200 transition text-center font-semibold text-red-500">📂 Upload Shell</a>
    <a href="/settings.php" class="block bg-gray-100 dark:bg-gray-700 p-4 rounded hover:bg-gray-200 transition text-center font-semibold text-yellow-500">⚙️ Cài đặt người dùng</a>
  </div>
</main>
<?php include '../footer.php'; ?>
