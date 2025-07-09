<?php
session_start();
include('../../includes/db.php');

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title']);
  $content = $_POST['content'];

  if (empty($title) || empty($content)) {
    $error = 'Vui lòng điền đầy đủ tiêu đề và nội dung.';
  } else {
    mysqli_query($conn, "INSERT INTO posts (title, content) VALUES ('$title', '$content')");
    $success = 'Bài viết đã được tạo thành công!';
  }
}
?>

<?php include('../header.php'); ?>
<script src="https://cdn.tiny.cloud/1/mz993y9zows6a7trn1nbc8pzs4ouk374xk87rgkq7f8j7v9d/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#content',
    plugins: 'image code link lists',
    toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | image link code',
    height: 400,
    branding: false
  });
</script>

<main class="max-w-2xl mx-auto mt-12 p-6 bg-white dark:bg-gray-800 rounded text-black dark:text-white">
  <h1 class="text-2xl font-bold mb-6 text-center">✍️ Viết bài mới</h1>

  <?php if ($error): ?>
    <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded"><?= $error ?></div>
  <?php endif; ?>
  <?php if ($success): ?>
    <div class="bg-green-100 text-green-700 px-4 py-2 mb-4 rounded"><?= $success ?></div>
  <?php endif; ?>

  <form method="POST" class="space-y-4">
    <input name="title" placeholder="Tiêu đề bài viết"
      class="w-full border p-2 rounded bg-gray-100 dark:bg-gray-700 text-black dark:text-white" />

    <textarea id="content" name="content" class="w-full h-64"></textarea>

    <button type="submit"
      class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full">Tạo bài viết</button>
  </form>
</main>

<?php include('../footer.php'); ?>