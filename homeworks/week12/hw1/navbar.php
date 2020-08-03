<?php
 require_once('conn.php');
 include_once('utils.php');
?>

<header id="warning">本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼</header>
<nav class="navbar">
	<div>
		<a class="navbar__title" href="./index.php" >FeiWen</a>
	</div>
	<div class="navbar__member">

	<?php
		include_once('check_login.php');
	?>

	</div>
</nav>
