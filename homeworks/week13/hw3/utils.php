<?php
require_once('conn.php');

// 透過 username 拿到 user 資料
function getUserFromUsername($username) {
  global $conn;
  $sql = "SELECT * FROM yu_users WHERE username = ? ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);
  $result = $stmt->execute();

  if (!$result) {
    die($conn->error);
  }

  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  return $row;
}

// XSS
function escape($str) {
  return htmlspecialchars($str, ENT_QUOTES);
}

?>