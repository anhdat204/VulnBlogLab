<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/functions.php';

// Không kiểm tra quyền – lỗi phân quyền
$result = mysqli_query($conn, "SELECT id, username, email, role FROM users");
?>

<?php include '../header.php'; ?>
<main class="max-w-4xl mx-auto mt-12 p-6 bg-white dark:bg-gray-800 rounded shadow">
  <h2 class="text-2xl font-bold mb-4 text-purple-500">👑 Quản lý người dùng</h2>
  <table class="w-full border text-sm">
    <thead>
      <tr class="bg-gray-200 dark:bg-gray-700">
        <th class="p-2">ID</th>
        <th>Tên đăng nhập</th>
        <th>Email</th>
        <th>Quyền</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr class="text-center border-t border-gray-600">
          <td class="p-1"><?= escape($row['id']) ?></td>
          <td><?= escape($row['username']) ?></td>
          <td><?= escape($row['email']) ?></td>
          <td class="text-indigo-500 font-semibold"><?= escape($row['role']) ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</main>
<?php include '../footer.php'; ?>
