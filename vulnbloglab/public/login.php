<?php
session_start();
include('../includes/db.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  $password_for_query = md5($password);
  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password_for_query'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) === 1) {
    $_SESSION['user'] = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $_SESSION['user']['id'];
    header('Location: /index.php');
    exit;
  } else {
    $error = 'Sai tài khoản hoặc mật khẩu.';
  }
}
?>

<?php include('header.php'); ?>
<main class="max-w-md mx-auto mt-16 p-6 bg-white dark:bg-gray-800 rounded shadow">
  <h2 class="text-2xl font-bold mb-4 text-center">🔐 Đăng nhập</h2>

  <?php if ($error): ?>
    <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded auto-dismiss">
      <?= $error ?>
    </div>
  <?php endif; ?>

  <form method="POST" class="space-y-4">
    <input name="username" placeholder="Tên đăng nhập" class="w-full border p-2 rounded bg-gray-100 dark:bg-gray-700" />
    <input name="password" type="password" placeholder="Mật khẩu" class="w-full border p-2 rounded bg-gray-100 dark:bg-gray-700" />
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full">Đăng nhập</button>
  </form>

  <p class="text-center text-sm text-gray-500 mt-4">
    Chưa có tài khoản? <a href="/register.php" class="text-blue-400 hover:underline">Đăng ký ngay</a>
  </p>
</main>
<?php include('footer.php'); ?>

<script>
  setTimeout(() => {
    const alert = document.querySelector('.auto-dismiss');
    if (alert) alert.remove();
  }, 3000);
</script>
