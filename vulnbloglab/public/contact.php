<?php
$message = "";
$show_debug = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = "admin@vulnbloglab.local";
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $body = $_POST['message'] ?? '';

    $headers = "From: $email\r\n";
    $full_message = "Name: $name\nEmail: $email\n\n$body";

    if (mail($to, $subject, $full_message, $headers)) {
        $message = "✅ Đã gửi liên hệ thành công!";
    } else {
        $message = "❌ Gửi thất bại.";
        $show_debug = true;
    }
}
?>

<?php include 'header.php'; ?>
<main class="max-w-xl mx-auto mt-12 bg-white dark:bg-gray-800 p-6 rounded shadow">
  <h2 class="text-2xl font-bold mb-4 text-lime-500">📮 Liên hệ với quản trị viên</h2>
  <p class="text-sm text-gray-400 mb-4">(Email Injection lab – subject có thể bị tiêm thêm header)</p>

  <?php if ($message): ?>
    <p class="mb-4 text-sm <?= str_contains($message, '✅') ? 'text-green-500' : 'text-red-500' ?>"><?= $message ?></p>
  <?php endif; ?>

  <form method="POST" class="space-y-4">
    <input name="name" placeholder="Tên của bạn" class="w-full p-2 rounded bg-gray-200 dark:bg-gray-700" required>
    <input name="email" placeholder="Email của bạn" class="w-full p-2 rounded bg-gray-200 dark:bg-gray-700" required>
    <input name="subject" placeholder="Tiêu đề" class="w-full p-2 rounded bg-gray-200 dark:bg-gray-700" required>
    <textarea name="message" rows="4" placeholder="Nội dung..." class="w-full p-2 rounded bg-gray-200 dark:bg-gray-700" required></textarea>
    <button class="bg-lime-600 hover:bg-lime-700 text-white px-4 py-2 rounded">Gửi liên hệ</button>
  </form>

  <?php if ($show_debug): ?>
    <pre class="mt-6 text-xs bg-gray-100 text-gray-600 p-3 rounded">
📤 Gửi đến: <?= $to . "\n" ?>
📨 Tiêu đề: <?= $subject . "\n" ?>
🧾 Header: <?= $headers ?>
    </pre>
  <?php endif; ?>
</main>
<?php include 'footer.php'; ?>
