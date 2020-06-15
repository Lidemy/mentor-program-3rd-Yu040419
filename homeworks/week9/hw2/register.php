<?php
require_once('conn.php');

$nickname = $_POST["nickname"];
$username = $_POST["username"];
$password = $_POST["password"];

$sql = sprintf(
	"INSERT INTO yu_users(nickname, username, password) VALUES ('%s', '%s', '%s')",
	$nickname,
	$username,
	$password);

if ($conn->query($sql)) {
	setcookie("username", $username, time() + 3600 * 24 * 30);
	setcookie("register_error", "", time() - 3600);
	header('Location: index.php');
} else {
	setcookie("register_error", "same_username", time() + 3600 * 24);
	header('Location: register_page.php');
}
?>