<?php
require_once('conn.php');
require_once('utils.php');

// get user id
if (!empty($_COOKIE['token'])) {
  $token = $_COOKIE['token'];
  $user = getUserFromToken($token);
  $user_id = $user['id'];
}

// add new comment
$text = $_POST['text'];
$sql = "INSERT INTO yu_comments(user_id, text) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('is', $user_id, $text);
$result = $stmt->execute();

if (!$result) {
  die($conn->error);
}

if($result) {
  header('Location: index.php');
} else {
  echo "新增失敗";
}
?>