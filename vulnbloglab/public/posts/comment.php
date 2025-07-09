<?php
session_start();
include('../../includes/db.php');

$post_id = $_POST['post_id'];
$author = mysqli_real_escape_string($conn, $_POST['author']);
$content = mysqli_real_escape_string($conn, $_POST['content']);

if (!empty($author) && !empty($content)) {
  $sql = "INSERT INTO comments (post_id, author, content) VALUES ('$post_id', '$author', '$content')";
  mysqli_query($conn, $sql);
}

header("Location: view.php?id=" . $post_id);
exit;
