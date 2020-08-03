<?php
	require_once('conn.php');
	include_once('utils.php');

	if (!empty($_COOKIE['token'])) {
		$token = $_COOKIE['token'];
		$user = getUserFromToken($token);
		$username = $user['username'];
		$user_id = $user['id'];
	}

	// 更改暱稱
	if (!empty($_POST["nickname"])) {
		$nickname = $_POST["nickname"];
		$sql = "UPDATE yu_users SET nickname = ? WHERE username = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('ss', $nickname, $username);
		$result = $stmt->execute();

		if (!$result) {
			die($conn->error);
		} else if ($result) {
			header('Location: profile.php');
		}
		
	// 更改帳號
	} else if (!empty($_POST["username"])) {
		$new_username = $_POST["username"];
		$sql = "UPDATE yu_users SET username = ? WHERE username = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('ss', $new_username, $username);
		$result = $stmt->execute();

		if ($conn->errno === 1062) {
			header('Location: profile.php?errcode=2');
		} else if ($result) {
			$sql = "UPDATE yu_users_certificates SET username = ? WHERE token = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('ss', $new_username, $token);
			$result = $stmt->execute();
			header('Location: profile.php');
		}

	// 更改密碼
	} else if (!empty($_POST["current-password"]) && !empty($_POST["new-password"])) {
		$old_password = $_POST["current-password"];

		// 驗證兩個新密碼是否相同
		if ($_POST["new-password"] !== $_POST["new-password-confirmed"]) {
			header('Location: profile.php?errcode=5');
		} else {
			$new_password = password_hash($_POST["new-password"], PASSWORD_DEFAULT);
			$sql =  "SELECT * FROM yu_users WHERE username = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('s', $username);
			$result = $stmt->execute();
			
			if(!$result) {
				die($conn->error);
			}
		
			$result = $stmt->get_result();
			$row = $result->fetch_assoc();

			// 如果舊密碼驗證成功
			if (password_verify($old_password, $row['password'])) {
				$sql = "UPDATE yu_users SET password = ? WHERE username = ?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param('ss', $new_password, $username);
				$result = $stmt->execute();

				if (!$result) {
					die($conn->error);
				}

				header('Location: profile.php?status=1');
			} else {
				header('Location: profile.php?errcode=3');
			}
		}
		
	// 編輯留言
	} else if (!empty($_POST["update__text"])) {
		$new_text = $_POST["update__text"];
		$comment_id = $_POST["id"];
		$sql = "UPDATE yu_comments SET text = ? WHERE comm_id = ? AND user_id = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('sii', $new_text, $comment_id, $user_id);
		$result = $stmt->execute();

		if (!$result) {
			die($conn->error);
		} else if ($result) {
			alert('成功編輯留言',  $_SERVER['HTTP_REFERER']);
		}

		
	}

?>