<?php
require_once('conn.php');
require_once('utils.php');
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FeiWen</title>
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
			$username = NULL;
			if (empty($_COOKIE['token'])) { ?>
				<a class='navbar__member--login' href='./login.php' >登入</a>
				<a class='navbar__member--register' href='./register.php' >註冊</a>
			</div>
		</nav>
		<div class='remind'>
			<div class='remind__text'>請登入或註冊</div>
		</div>
		<?php
			} else {
				$token = $_COOKIE['token'];
				$user = getUserFromToken($token);
				$username = $user['username'];
				$nickname = $user['nickname'];
			?>
				<a class='navbar__member--name' href='./profile.php'><?php echo escape($nickname) ?></a>
				<a class='navbar__member--logout' href='./logout.php' >登出</a>
			</div>
		</nav>
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
						<input type='submit' class='submit' value='送出' />
					</form>
				</div>
			</div>
		</div>
		<div class="my__comment">我的留言</div>
		<?php
			}
		?>
		<div class="comment">
			<?php
				$sql = "SELECT yu_users.nickname, yu_users.username, yu_comments.comm_id, yu_comments.text, yu_comments.create_at AS time, yu_comments.is_deleted  
					FROM yu_users JOIN yu_comments ON yu_users.id = yu_comments.user_id 
					WHERE yu_users.username = ? AND yu_comments.is_deleted IS NULL 
					ORDER BY time DESC LIMIT 50";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param('s', $username);
				$result = $stmt->execute();

				if (!$result) {
					die($conn->error);
				}

				$result = $stmt->get_result();
				while($row = $result->fetch_assoc()) { 
					echo "<div class='comment__block'>";
					echo 	 "<div class='comment__block--info'>";
					if ($row['username'] === $username) {
						$a = sprintf(
							"<a href='./handle_delete_comment.php?id=%d'><img src='./img/delete.png' title='刪除留言' class='img comment__delete' /></a>",
							$row['comm_id']
						);
						echo   "<div class='comment__info--name'>" . escape($row['nickname']) . 
										 " <span>(@" . escape($row['username']) . " )</span>
										 <a><img src='./img/edit.png' title='編輯留言' class='img comment__edit' /></a>" . 
										 $a . 
									 "</div>";
					} else {
					  echo 	 "<div class='comment__info--name'>" . escape($row['nickname']) . 
										 " <span>(@" . escape($row['username']) . " )</span>
									 </div>";
					}
					echo     "<div class='comment__info--time'>" . escape($row['time']) . "</div>";
					echo   "</div>";
					echo   "<div class='comment__text'>" . escape($row['text']) . "</div>";
					echo   "<form class='comment__update hidden' action='./handle_update.php' method='POST'>";
					echo     "<textarea class='comment__update--text' name='update__text'>" . escape($row['text']) . "</textarea>";
					$input = sprintf(
						"<input type='hidden'name='id' value='%d' />",
						$row['comm_id']
					);
					echo     $input;
					echo     "<input type='submit' class='btn comment__update--confirm' value='編輯留言' />";
					echo     "<span class='comment__update--cancel' >取消編輯</span>";
					echo   "</form>";
					echo "</div>";
				}

				?>
	</div>
	<script>
		const btn = document.querySelector('.wrap');
		btn.addEventListener('click', (e) => {

			// 編輯暱稱
			if (e.target.classList.contains('update__nickname')) {
				const nicknameForm = document.querySelector('.my__nickname--update');
				nicknameForm.classList.toggle('hidden');

				// 編輯帳號
			} else if (e.target.classList.contains('update__username')) {
				const usernameForm = document.querySelector('.my__username--update');
				usernameForm.classList.toggle('hidden');

				// 編輯密碼
			} else if (e.target.classList.contains('update__password')) {
				const passwordForm = document.querySelector('.my__password--update');
				passwordForm.classList.toggle('hidden');

				// 編輯留言，有 BUG，如果修改後按取消留言後，再次按編輯留言會是之前修改過後的
			} else if (e.target.classList.contains('comment__edit')) {
				const commentBlock = e.target.parentNode.parentNode.parentNode.parentNode;
				const commentForm = commentBlock.lastChild;
				const commentText = commentForm.previousSibling;
				commentText.classList.toggle('hidden');
				commentForm.classList.toggle('hidden');

				// 取消編輯留言，有 BUG，同上
			} else if (e.target.classList.contains('comment__update--cancel')) {
				const commentForm = e.target.parentNode;
				const commentText = commentForm.previousSibling;
				commentText.classList.toggle('hidden');
				commentForm.classList.toggle('hidden');
			}
		})
	</script>
</body>
</html>