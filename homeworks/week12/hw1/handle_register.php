<?php
require_once('conn.php');
include_once('utils.php');

$nickname = $_POST["nickname"];
$username = $_POST["username"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

if (empty($nickname) || empty($username) || empty($password)) {
	header('Location: register.php?errcode=1');
	die();
}

$sql = "INSERT INTO yu_users(nickname, username, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $nickname, $username, $password);
$result = $stmt->execute();

if($conn->errno === 1062) {
	header('Location: register.php?errcode=2');
} else if ($result) {
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
}
?>