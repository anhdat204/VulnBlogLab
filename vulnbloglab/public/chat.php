<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: /login.php");
  exit;
}
include('../includes/ai.php');

$response = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $question = trim($_POST['prompt']);
  if ($question !== '') {
    $response = call_ai($question);

    $log_line = "[" . date('Y-m-d H:i:s') . "] user={$_SESSION['user']['email']} prompt=\"" . addslashes($question) . "\" response=\"" . addslashes($response) . "\"\n";
    file_put_contents(__DIR__ . '/../logs/chat.log', $log_line, FILE_APPEND);
  }
}
?>


<?php include('header.php'); ?>
<main class="max-w-3xl mx-auto mt-10 p-6 bg-white dark:bg-gray-800 rounded">
  <h1 class="text-2xl font-bold mb-4">🤖 Chat với AI</h1>

  <form method="POST" class="space-y-4">
    <textarea name="prompt" placeholder="Hỏi gì đó..." class="w-full border p-3 rounded dark:bg-gray-700"></textarea>
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Gửi</button>
  </form>

  <?php if ($response): ?>
    <div class="mt-6 p-4 bg-gray-100 dark:bg-gray-700 rounded">
      <strong>AI trả lời:</strong>
      <p class="mt-2 whitespace-pre-line"><?= nl2br(htmlspecialchars($response)) ?></p>
    </div>
  <?php endif; ?>
</main>
<?php include('footer.php'); ?>