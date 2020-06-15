<?php
setcookie("login_error", "", time() - 3600);
setcookie("register_error", "", time() - 3600);
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HW2</title>
	<link rel="stylesheet" href="./style.css">
</head>
<body>
	<div class="wrap">
		<header id="warning">本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼</header>
		<nav class="navbar">
			<div>
				<a class="navbar__title" href="./index.php" >FeiWen</a>
				<span class="navbar__slogan">我最廢</span>
			</div>
			<div class="navbar__member">
			<?php
			require_once('conn.php');

			if (isset($_COOKIE['username'])) {
				$username = NULL;
				
				if (!empty($_COOKIE["username"])) {
					$username = $_COOKIE["username"];
				}
				$sql = sprintf(
					"SELECT nickname FROM yu_users WHERE username = '%s'",
					$username
				);
				$result = $conn->query($sql);

				if (!$result) {
					die($conn->error);
				}

				$row = $result->fetch_assoc();
				$nickname = $row['nickname'];

				echo 	   "<div class='navbar__member--name'>" . $nickname . "</div>";
				echo     "<a class='navbar__member--logout' href='./logout.php' >登出</a>";
				echo   "</div>";
				echo "</nav>";
				echo "<div class='new__comment'>";
				echo "<div class='new__comment--name'>" . $nickname . "</div>";
				echo "<form class='new__comment--block' action='./add.php' method='POST' >";
				echo   "<textarea name='text' class='new__comment--text' placeholder='輸入您的廢文' required></textarea>";
				echo	 "<input type='submit' class='btn' value='送出' />";
				echo "</form>";
			} else {
				echo     "<a class='navbar__member--login' href='./login_page.php' >登入</a>";
				echo     "<a class='navbar__member--register' href='./register_page.php' >註冊</a>";
				echo 	 "</div>";
				echo "</nav>";
				echo "<div class='remind'>";
				echo 	 "<div class='remind__text'>註冊會員後即可發布您的廢文</div>";
				echo "</div>";
			}
			?>
		<div class="latest">LATEST ARTICLES</div>
		<div class="comment">
			<?php
				require_once('conn.php');

				$sql = "SELECT yu_users.nickname, yu_comments.text, yu_comments.create_at AS time FROM yu_users JOIN yu_comments ON yu_users.id = yu_comments.user_id ORDER BY time DESC LIMIT 50";
				$result = $conn->query($sql);

				if (!$result) {
					die($conn->error);
				}

				while($row = $result->fetch_assoc()) {
					echo "<div class='comment__block'>";
					echo 	 "<div class='comment__block--info'>";
					echo 		 "<div class='comment__info--name'>" . $row['nickname'] . "</div>";
					echo     "<div class='comment__info--time'>" . $row['time'] . "</div>";
					echo   "</div>";
					echo   "<div class='comment__text'>" . $row['text'] . "</div>";
					echo "</div>";
				}

				?>
		</div>
	</div>
</body>
</html>