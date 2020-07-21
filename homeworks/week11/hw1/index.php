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
			if (!empty($_COOKIE['token'])) {
				$token = $_COOKIE['token'];
				$user = getUserFromToken($token);
				$nickname = $user['nickname'];
				$username = $user['username'];
				
				echo 	    	"<a class='navbar__member--name' href='./profile.php'>" . escape($nickname) . "</a>";
				echo      	"<a class='navbar__member--logout' href='./logout.php' >登出</a>";
				echo     "</div>";
				echo   "</nav>";
				echo   "<div class='new__comment'>";
				echo     "<div class='new__comment--name'>" . escape($nickname) . "</div>";
				echo     "<form class='new__comment--block' action='./add.php' method='POST' >";
				echo       "<textarea name='text' class='new__comment--text' placeholder='輸入您的廢文' required></textarea>";
				echo	     "<input type='submit' class='btn' value='送出' />";
				echo     "</form>";
				echo   "</div>";
			} else {
				echo     "<a class='navbar__member--login' href='./login.php' >登入</a>";
				echo     "<a class='navbar__member--register' href='./register.php' >註冊</a>";
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
				$page = 1;
				if (!empty($_GET['page'])) {
					$page = intval($_GET['page']);
				}

				$comments_per_page = 20;
				$offset = ($page - 1) * $comments_per_page;
				$sql = "SELECT yu_users.nickname, yu_users.username, yu_comments.comm_id, yu_comments.text, yu_comments.create_at AS time, yu_comments.is_deleted " . 
					"FROM yu_users JOIN yu_comments ON yu_users.id = yu_comments.user_id " . 
					"WHERE yu_comments.is_deleted IS NULL " . 
					"ORDER BY time DESC LIMIT ? OFFSET ?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param('ii', $comments_per_page, $offset);
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
						echo "<div class='comment__info--name'>" . escape($row['nickname']) . 
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
	<div class='page'>
		<?php
			$sql = "SELECT COUNT(comm_id) AS total, yu_comments.is_deleted " . 
				"FROM yu_users JOIN yu_comments ON yu_users.id = yu_comments.user_id " . 
				"WHERE yu_comments.is_deleted IS NULL";
			$stmt = $conn->prepare($sql);
			$result = $stmt->execute();
			$result = $stmt->get_result();

			if (!$result) {
				die($conn->error);
			}

			$row = $result->fetch_assoc();
			$total_comments = $row['total'];
			$total_pages = ceil($total_comments / $comments_per_page);
		

			if ($page != 1) { ?>
				<a href='index.php?page=<?php echo $page - 1 ?>' class='page__btn'>上一頁</a>
				<?php	
			} 

			for ($i = 1; $i <= $total_pages; $i += 1) {
				if ($page == $i) {	?>
				<span class='on'><?php echo $i ?></span>
				<?php
				} else { ?>
				<a href='index.php?page=<?php echo $i ?>' class='page__btn'><?php echo $i ?></a>
				<?php
				}
			}
			
			if ($page != $total_pages) { ?>
				<a href='index.php?page=<?php echo $page + 1 ?>' class='page__btn'>下一頁</a>
				<?php	
			} ?>
	</div>
	<script>
		const btn = document.querySelector('.wrap');
		btn.addEventListener('click', (e) => {
			if (e.target.classList.contains('comment__edit')) {
				const commentForm = e.target.parentNode.parentNode.parentNode.parentNode.lastChild;
				const commentText = commentForm.previousSibling;
				commentText.classList.toggle('hidden');
				commentForm.classList.toggle('hidden');
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