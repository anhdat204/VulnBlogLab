<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_dir = __DIR__ . '/uploads/attachments/';
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $file_name;


    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        file_put_contents(__DIR__ . '/../logs/upload.log', "[" . date('Y-m-d H:i:s') . "] user={$_SESSION['user']['email']} file=$file_name ip={$_SERVER['REMOTE_ADDR']}\n", FILE_APPEND);
        $url = "/uploads/attachments/" . urlencode($file_name);
        $message = "<span class='text-green-500'>✅ File uploaded: <a class='underline' href='$url'>$file_name</a></span>";
    } else {
        $message = "<span class='text-red-500'>❌ Upload failed!</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi" class="dark">

<head>
    <meta charset="UTF-8">
    <title>Upload Shell - VulnBlogLab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white min-h-screen px-6 py-12">
    <div class="max-w-lg mx-auto bg-gray-800 p-6 rounded-lg shadow-xl">
        <h1 class="text-2xl font-bold text-red-400 mb-4">📂 Upload Shell</h1>
        <form action="" method="post" enctype="multipart/form-data" class="space-y-4">
            <input type="file" name="fileToUpload" required class="bg-gray-700 text-white p-2 rounded w-full">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white">Tải lên</button>
        </form>
        <div class="mt-4 text-sm"><?= $message ?></div>
    </div>
</body>

</html>