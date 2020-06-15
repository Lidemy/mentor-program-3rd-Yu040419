<?php
  require('conn.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = sprintf(
    "SELECT * FROM yu_users WHERE username='%s' AND password='%s'",
    $username,
    $password
  );
  $result = $conn->query($sql);
  if (!$result) {
    die($conn->error);
  }

  if ($result->num_rows > 0) {
    setcookie("username", $username, time() + 3600 * 24 * 30);
    setcookie("login_error", "", time() - 3600);
    header('Location: index.php');
  } else {
    setcookie("login_error", "wrong_username", time() + 3600 * 24);
    header('Location: login_page.php');
  }
?>
