<?php
$target = '../uploads/images/';
if (!is_dir($target)) mkdir($target, 0777, true);

$file = $_FILES['image'];
$name = time() . '-' . basename($file['name']);
$path = $target . $name;
move_uploaded_file($file['tmp_name'], $path);

echo json_encode([
  'url' => "/uploads/images/$name"
]);
