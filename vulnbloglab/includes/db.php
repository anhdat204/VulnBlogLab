<?php 
$host = 'db';
$db   = 'vulnlab';
$user = 'root';
$pass = 'toor';

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
  die("Lỗi kết nối MySQL: " . mysqli_connect_error());
}
?>