<?php
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/functions.php';

// Không kiểm tra is_admin() để mô phỏng bypass
$chat_log = file_exists('../../logs/chat.log') ? file_get_contents('../../logs/chat.log') : 'Không có log chat.';
$upload_log = file_exists('../../logs/upload.log') ? file_get_contents('../../logs/upload.log') : 'Không có log upload.';
?>

<?php include '../header.php'; ?>
<main class="max-w-5xl mx-auto mt-12 p-6 bg-white dark:bg-gray-800 rounded shadow">
  <h2 class="text-2xl font-bold mb-6 text-indigo-400">📄 Nhật ký hệ thống</h2>

  <section class="mb-10">
    <h3 class="text-lg font-semibold text-indigo-300 mb-2">🤖 Chat AI Log</h3>
    <pre class="bg-gray-100 dark:bg-gray-900 text-xs text-gray-800 dark:text-gray-200 p-4 rounded whitespace-pre-wrap max-h-72 overflow-auto"><?= $chat_log ?></pre>
  </section>

  <section>
    <h3 class="text-lg font-semibold text-indigo-300 mb-2">📂 Upload File Log</h3>
    <pre class="bg-gray-100 dark:bg-gray-900 text-xs text-gray-800 dark:text-gray-200 p-4 rounded whitespace-pre-wrap max-h-72 overflow-auto"><?= $upload_log ?></pre>
  </section>
</main>
<?php include '../footer.php'; ?>
