<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/csrf.php';

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn, "SELECT email FROM users WHERE id = $user_id");
$user = mysqli_fetch_assoc($result);

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_email = mysqli_real_escape_string($conn, $_POST['email']);
    mysqli_query($conn, "UPDATE users SET email = '$new_email' WHERE id = $user_id");
    $message = "✅ Email đã được cập nhật!";
    $user['email'] = $_POST['email'];
}
?>

<?php include 'header.php'; ?>
<main class="max-w-xl mx-auto mt-12 bg-white dark:bg-gray-800 p-6 rounded shadow">
  <h2 class="text-2xl font-bold mb-4 text-indigo-500">⚙️ Cài đặt tài khoản</h2>
  <p class="text-gray-400 text-sm mb-6">(CSRF Test – bạn có thể mô phỏng tấn công POST ngầm)</p>

  <form method="POST" class="space-y-4">
    <input type="hidden" name="csrf_token" value="<?= generate_csrf_token() ?>">
    <label class="block text-sm font-medium">Email:</label>
    <input type="email" name="email" value="<?= escape($user['email'] ?? '') ?>" class="w-full p-2 rounded bg-gray-200 dark:bg-gray-700">
    <button class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded text-white">Lưu thay đổi</button>
  </form>

  <?php if ($message): ?>
    <p class="mt-4 text-green-500"><?= $message ?></p>
  <?php endif; ?>
</main>
<?php include 'footer.php'; ?>
