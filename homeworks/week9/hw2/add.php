<?php
require_once('conn.php');

// get user id
$username = NULL;
if (!empty($_COOKIE["username"])) {
	$username = $_COOKIE["username"];
}
$sql = sprintf(
  "SELECT id FROM yu_users WHERE username = '%s'",
  $username
);
$result = $conn->query($sql);

if(!$result) {
  die($conn->error);
}
$row = $result->fetch_assoc();
$id = $row['id'];

// add new comment
$text = $_POST['text'];
$sql = sprintf(
  "INSERT INTO yu_comments(user_id, text) VALUES (%d, '%s')",
  $id,
  $text
);
$result = $conn->query($sql);

if (!$result) {
  die($conn->error);
}

if($result) {
  header('Location: index.php');
} else {
  echo "新增失敗";
}
?>