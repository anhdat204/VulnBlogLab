<?php
session_start();

include('../includes/db.php');

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $confirm  = trim($_POST['confirm']);

  if (empty($username) || empty($password) || empty($confirm)) {
    $error = 'Vui lòng điền đầy đủ thông tin.';
  } elseif ($password !== $confirm) {
    $error = 'Mật khẩu không khớp.';
  } else {
    $hashed = md5($password);
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($check) > 0) {
      $error = 'Tên người dùng đã tồn tại.';
    } else {
      mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$hashed')");
      $success = 'Đăng ký thành công! Bạn có thể đăng nhập.';
    }
  }
}
?>

<?php include('header.php'); ?>
<main class="max-w-md mx-auto mt-16 p-6 bg-white dark:bg-gray-800 rounded shadow">
  <h2 class="text-2xl font-bold mb-4 text-center">🚀 Đăng ký tài khoản</h2>

  <?php if ($error): ?>
    <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded"> <?= $error ?> </div>
  <?php endif; ?>

  <?php if ($success): ?>
    <div class="bg-green-100 text-green-700 px-4 py-2 mb-4 rounded"> <?= $success ?> </div>
  <?php endif; ?>

  <form method="POST" class="space-y-4">
    <input name="username" placeholder="Tên đăng nhập" class="w-full border p-2 rounded bg-gray-100 dark:bg-gray-700" />
    <input name="password" type="password" placeholder="Mật khẩu" class="w-full border p-2 rounded bg-gray-100 dark:bg-gray-700" />
    <input name="confirm" type="password" placeholder="Nhập lại mật khẩu" class="w-full border p-2 rounded bg-gray-100 dark:bg-gray-700" />
    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded w-full">Đăng ký</button>
  </form>

  <p class="text-center text-sm text-gray-500 mt-4">
    Đã có tài khoản? <a href="/login.php" class="text-blue-400 hover:underline">Đăng nhập ngay</a>
  </p>
</main>
<?php include('footer.php'); ?>
