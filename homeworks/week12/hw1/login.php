<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FeiWen</title>
	<link rel="stylesheet" href="CSS/normalize.css">
	<link rel="stylesheet" href="CSS/style.css">
</head>
<body>
	<div class="wrap">

		<?php
		include_once('navbar.php');
		?>
		
		<div class="login__title">會員登入</div>
		<?php
		if (isset($_GET['errcode'])) {
			if ($_GET['errcode'] === '1') {
				echo "<div class='login__err'>請完整輸入帳號及密碼</div>";
			} else if ($_GET['errcode'] === '2') {
				echo "<div class='login__err'>帳號或密碼輸入錯誤</div>";
			}
		}
    ?>
		<div class="login">
			<form class="login__block" action="./handle_login.php" method="POST" >
				<div>帳號： <input class="login__username" placeholder="請輸入帳號（必填）" name="username" type="text" required /></div>
				<div>密碼： <input class="login__password" placeholder="請輸入密碼（必填）" name="password" type="password" required /></div>
				<input class="btn" type="submit" value="登入"/>
			</form>
		</div>
	</div>
</body>
</html>