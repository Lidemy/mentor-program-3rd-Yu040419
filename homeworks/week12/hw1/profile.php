<?php
require_once('conn.php');
include_once('utils.php');
?>
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

		if (empty($_COOKIE['token'])) { ?>
			<div class='remind'>
				<div class='remind__text'>請登入或註冊</div>
			</div>
		<?php
		} else { ?>

		<div class='my__profile'>
			<div class='my__profile--title'>個人資料</div>
			<?php
				if (isset($_GET['errcode'])) {
					if ($_GET['errcode'] === '1') {
						echo "<div class='profile__err'>請輸入欲更改的內容</div>";
					} else if ($_GET['errcode'] === '2') {
						echo "<div class='profile__err'>此帳號已有人使用</div>";
					} else if ($_GET['errcode'] === '3') {
						echo "<div class='profile__err'>舊密碼輸入錯誤</div>";
					} else if ($_GET['errcode'] === '4') {
						echo "<div class='comment__update--err'>刪除廢文失敗，請稍後再試一次</div>";
					} else if ($_GET['errcode'] === '5') {
						echo "<div class='profile__err'>新密碼設定失敗，請輸入兩次相同的新密碼</div>";
					}
				} else if (isset($_GET['status'])) {
					echo "<div class='profile__remind'>密碼更新成功</div>";
				}
    	?>
			<div class='my__profile--border'>
				<div class='my__profile--block'>
					<div class='my__profile--nickname'>暱稱：<span name='nickname' class='my__profile--update--nickname'><?php echo escape($nickname) ?>
							<img src='./img/edit.png' title='編輯暱稱' class='img update__nickname' />
						</span>
					</div>
					<form class='my__nickname--update hidden' action ='./handle_update.php' method='POST' >
						<input class='my__profile--input' name='nickname' type='text' placeholder='請輸入新暱稱' required/>
						<input type='submit' class='submit' value='送出' />
					</form>
				</div>
				<div class='my__profile--block'>
					<div class='my__profile--username'>帳號：<span name='nickname' class='my__profile--update--username'><?php echo escape($username) ?>
							<img src='./img/edit.png' title='編輯帳號' class='img update__username' />
						</span>
					</div>
					<form class='my__username--update hidden' action ='./handle_update.php' method='POST' >
						<input class='my__profile--input' name='username' type='text' placeholder='請輸入新帳號' required/>
						<input type='submit' class='submit' value='送出' />
					</form>
				</div>
				<div class='my__profile--block'>
					<div class='my__profile--password'>密碼：<img src='./img/edit.png' title='編輯密碼' class='img update__password' /></div>
					<form class='my__password--update hidden' action ='./handle_update.php' method='POST' >
						<input class='my__profile--input' name='current-password' type='password' placeholder='請輸入舊密碼' required/>
						<input class='my__profile--input' name='new-password' type='password' placeholder='請輸入新密碼' required/>
						<input class='my__profile--input' name='new-password-confirmed' type='password' placeholder='請再次輸入新密碼' required/>
						<input type='submit' class='submit password__submit' value='送出' />
					</form>
				</div>
			</div>
		</div>
		<div class="my__comment">MY ARTICLES</div>
		<?php
		}
		?>
		<div class="comment">
			<?php
				$sql = "SELECT U.nickname, U.username, C.comm_id, C.parent_id, C.text, C.create_at AS time, C.is_deleted  
					FROM yu_users AS U JOIN yu_comments AS C ON U.id = C.user_id 
					WHERE U.username = ? AND C.is_deleted IS NULL AND C.parent_id = 0
					ORDER BY time DESC LIMIT 50";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param('s', $username);
				$result = $stmt->execute();

				if (!$result) {
					die($conn->error);
				}

				$result = $stmt->get_result();
				while ($row = $result->fetch_assoc()) { 
					
					// 載入文章
					include('show_comments.php');
				}
				
				// 如果沒有文章
				if ($result->num_rows == 0) { 
			?>
					<div class='nocomment'>目前還沒有廢文，快去首頁分享吧！</div>

			<?php
				}
			?>
	</div>
	<script src="update.js"></script>

</body>
</html>