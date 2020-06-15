<?php
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
				<a class="navbar__member--register" href="./register_page.php" >註冊</a>
			</div>
		</nav>
		<div class="login__title">會員登入</div>
		<?php
    if (isset($_COOKIE['login_error'])) {
      echo "<div class='login__err'>帳號或密碼輸入錯誤</div>";
    }
    ?>
		<div class="login">
			<form class="login__block" action="./login.php" method="POST" >
				<div>帳號： <input class="login__username" placeholder="請輸入帳號" name="username" type="text" required /></div>
				<div>密碼： <input class="login__password" placeholder="請輸入密碼" name="password" type="password" required /></div>
				<input class="btn" type="submit" value="登入"/>
			</form>
		</div>
	</div>
</body>
</html>