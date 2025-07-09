<?php
$query = $_GET['q'] ?? '';
?>

<?php include 'header.php'; ?>
<main class="max-w-xl mx-auto mt-12 bg-white dark:bg-gray-800 p-6 rounded shadow">
  <h2 class="text-2xl font-bold mb-4 text-orange-500">🔎 Tìm kiếm</h2>

  <form method="GET" class="mb-6">
    <input type="text" name="q" placeholder="Nhập từ khoá..." value="<?= htmlspecialchars($query) ?>" class="w-full p-2 rounded bg-gray-200 dark:bg-gray-700">
    <button class="mt-2 bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded">Tìm kiếm</button>
  </form>

  <?php if ($query): ?>
    <p class="text-sm text-gray-500">Kết quả cho từ khoá: <strong><?= $query ?></strong></p>
    <div class="mt-4 p-4 bg-gray-100 dark:bg-gray-700 rounded text-sm">
      ❌ Không có kết quả nào cho từ khoá "<strong><?= $query ?></strong>"
    </div>
  <?php endif; ?>
</main>
<?php include 'footer.php'; ?>
