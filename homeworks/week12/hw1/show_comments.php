<?php

	// 主留言
	echo "<div class='comment__block'>";
	echo 	 "<div class='comment__block--info'>";

	if ($row['username'] === $username) {
		
		/*
		剛開始嘗試透過從 <a> 錨點做 confirm，但失敗

		$location = sprintf(
			'./handle_delete_comment.php?id=%d',
			escape($row['comm_id'])
		);

		$a = sprintf(
			"<a href='javascript:if(confirm(%s))location=%s'><img src='./img/delete.png' title='刪除廢文' class='img comment__delete' /></a>",
			"確實要刪除嗎?",
			$location
		);

		也試過 onclick 用法，但也失敗

		$onclick = sprintf(
			'return confirm(%s)',
			'確實要刪除嗎?'
		);

		 $a = sprintf(
				"<a href='./handle_delete_comment.php?id=%d' onClick=%s><img src='./img/delete.png' title='刪除廢文' class='img comment__delete' /></a>",
				escape($row['comm_id']),
		   $onclick
		);

		*/

		$a = sprintf(
			"<a href='./check_delete.php?id=%d'><img src='./img/delete.png' title='刪除廢文' class='img comment__delete' /></a>",
			escape($row['comm_id'])
		);

		echo  "<div class='comment__info--name'>" . escape($row['nickname']);
		echo		" <span>(@" . escape($row['username']) . " )</span>";
		echo		"<a><img src='./img/edit.png' title='編輯廢文' class='img comment__edit' /></a>";
		echo		$a;
		echo	"</div>";
	
	} else {
		echo 	"<div class='comment__info--name'>" . escape($row['nickname']);
		echo		" <span>(@" . escape($row['username']) . " )</span>";
		echo	"</div>";
	}
	
	echo     "<div class='comment__info--time'>" . escape($row['time']) . "</div>";
	echo   "</div>";

	$text = sprintf(
		"<div class='comment__text' data-id='%d'>%s</div>",
		escape($row['comm_id']),
		escape($row['text'])
	);

	echo  $text;

	// 子留言
	include('show_subcomments.php');

	// 新增子留言
	if (!empty($_COOKIE['token'])) {

		echo  "<form class='subcomment__form' action ='./handle_add_comment.php' method='POST' >";
		echo		"<textarea class='subcomment__input' name='text' placeholder='輸入回覆 . . .' required></textarea>";
		
		$parent_id = sprintf(
			"<input type='hidden' name='parent_id' value='%d' />",
			escape($row['comm_id'])
		);
	
		echo		$parent_id;
		echo		"<input type='submit' class='btn' value='我要回覆' />";
		echo	"</form>";
	}
	
	echo "</div>";
?>