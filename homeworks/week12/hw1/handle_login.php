<?php
  require_once('conn.php');
  include_once('utils.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username) || empty($password)) {
    header('Location: login.php?errcode=1');
    exit();
  }

  $sql =  "SELECT * FROM yu_users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);
  $result = $stmt->execute();

  if(!$result) {
    die($conn->error);
  }

  $result = $stmt->get_result();
  if ($result->num_rows === 0) {
    header('Location: login.php?errcode=2');
    exit();
  }

  $row = $result->fetch_assoc();
  if (password_verify($password, $row['password'])) {
    $token = getToken();
    $sql =  "INSERT INTO yu_users_certificates(username, token) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $token);
    $result = $stmt->execute();

    if(!$result) {
      die($conn->error);
    }

    setcookie("token", $token, time() + 3600 * 24 * 30);
    header('Location: index.php');
  } else {
    header('Location: login.php?errcode=2');
  }
?>
