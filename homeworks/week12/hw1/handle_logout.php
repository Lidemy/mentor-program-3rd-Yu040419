<?php
require_once('conn.php');

$token = NULL;
if (!empty($_COOKIE['token'])) {
  $token = $_COOKIE['token'];
}

$sql =  "DELETE FROM yu_users_certificates WHERE token = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $token);
$result = $stmt->execute();

setcookie('token', '', time() - 3600);
header('Location: index.php');
?>