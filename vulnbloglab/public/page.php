<?php
$page = $_GET['page'] ?? 'about';
$path = "pages/$page.php";

if (!preg_match('/^[\w\-]+$/', $page)) {
    die("❌ Đường dẫn không hợp lệ.");
}

if (!file_exists($path)) {
    die("❌ Không tìm thấy trang.");
}
?>

<?php include 'header.php'; ?>
<main class="max-w-xl mx-auto mt-12 bg-white dark:bg-gray-800 p-6 rounded shadow">
  <?php include $path; ?>
</main>
<?php include 'footer.php'; ?>
