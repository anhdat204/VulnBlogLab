<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

$profile_id = isset($_GET['id']) ? (int)$_GET['id'] : $_SESSION['user_id'];

$sql = "SELECT id, username, bio FROM users WHERE id = $profile_id";
$result = mysqli_query($conn, $sql);
$profile = mysqli_fetch_assoc($result);

if (!$profile) {
    http_response_code(404);
    die("❌ Không tìm thấy người dùng.");
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $profile['id'] === $_SESSION['user_id']) {
    $new_bio = $_POST['bio'] ?? '';
    $escaped = mysqli_real_escape_string($conn, $new_bio);
    mysqli_query($conn, "UPDATE users SET bio = '$escaped' WHERE id = {$profile['id']}");
    $message = "✅ Đã cập nhật mô tả!";
    $profile['bio'] = $new_bio;
}
?>

<?php include 'header.php'; ?>
<main class="max-w-xl mx-auto mt-12 bg-white dark:bg-gray-800 p-6 rounded shadow">
  <h2 class="text-2xl font-bold mb-2 text-center text-blue-500">👤 Hồ sơ người dùng</h2>
  <p class="text-center text-gray-400 text-sm mb-4">(IDOR + Stored XSS)</p>

  <div class="mb-4">
    <strong>Tên đăng nhập:</strong> <?= escape($profile['username']) ?>
  </div>

  <div class="mb-4">
    <strong>Giới thiệu:</strong>
    <div class="mt-1 p-3 bg-gray-100 dark:bg-gray-700 rounded text-sm">
      <?= $profile['bio'] ?: '<i>Chưa có mô tả</i>' ?> <!-- Không escape để hiển thị XSS -->
    </div>
  </div>

  <?php if ($profile['id'] === $_SESSION['user_id']): ?>
    <form method="POST" class="space-y-2 mt-4">
      <textarea name="bio" rows="4" class="w-full p-2 rounded bg-gray-200 dark:bg-gray-700"><?= escape($profile['bio']) ?></textarea>
      <button class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white">Lưu mô tả</button>
    </form>
  <?php endif; ?>

  <?php if ($message): ?>
    <p class="mt-3 text-green-400"><?= $message ?></p>
  <?php endif; ?>
</main>
<?php include 'footer.php'; ?>
