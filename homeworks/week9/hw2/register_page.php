<?php
setcookie("login_error", "", time() - 3600);
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
				<a class="navbar__member--login" href="./login_page.php" >登入</a>
			</div>
		</nav>
		<div class="register__title">會員註冊</div>
		<?php
    if (isset($_COOKIE['register_error'])) {
      echo "<div class='register__err'>暱稱或帳號已有人使用</div>";
    }
    ?>
		<div class="register">
			<form class="register__block" action="./register.php" method="POST" >
				<div>暱稱： <input class="register__nickname" placeholder="請輸入暱稱" name="nickname" type="text" required /></div>
				<div>帳號： <input class="register__username" placeholder="請輸入帳號" name="username" type="text" required /></div>
				<div>密碼： <input class="register__password" placeholder="請輸入密碼" name="password" type="password" required /></div>
				<input class="btn" type="submit" value="註冊"/>
			</form>
		</div>
	</div>
</body>
</html>