<?php
require_once('conn.php');

 // 製造亂碼
function getToken() {
  $str = '';
  for($i = 1; $i <= 16; $i += 1) {
    $str .= chr(rand(65,90));
  }
  return $str;
}

// 透過 token 拿到 user 資料
function getUserFromToken($token) {
  global $conn;
  $sql = "SELECT yu_users.id, yu_users.nickname, yu_users.username, yu_users_certificates.token 
    FROM yu_users JOIN yu_users_certificates ON yu_users.username = yu_users_certificates.username 
    WHERE yu_users_certificates.token = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $token);
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