<?php
require_once('conn.php');
require_once('utils.php');

if (empty($_POST['text'])) {
  alert('請輸入內容', $_SERVER['HTTP_REFERER']);
}

// get user id
if (!empty($_COOKIE['token'])) {
  $token = $_COOKIE['token'];
  $user = getUserFromToken($token);
  $user_id = $user['id'];
}

// add comment
$text = $_POST['text'];
$parent_id = $_POST['parent_id'];
$sql = "INSERT INTO yu_comments(user_id, parent_id, text) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iis', $user_id, $parent_id, $text);
$result = $stmt->execute();

if (!$result) {
  die($conn->error);
}

if ($result) {
  alert('已成功送出', $_SERVER['HTTP_REFERER']);
}
?>