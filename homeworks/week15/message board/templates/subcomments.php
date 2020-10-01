<?php
  require_once('conn.php');
  include_once('utils.php');
  
  echo  "<div class='subcomments'>";

  $parent_id = $row['comm_id'];

  $sql_sub = "SELECT U.nickname, U.username, C.comm_id, C.parent_id, C.text, C.create_at AS time, C.is_deleted
    FROM yu_users AS U JOIN yu_comments AS C ON U.id = C.user_id
    WHERE C.is_deleted IS NULL AND C.parent_id = ?
    ORDER BY time ASC";
  $stmt_sub = $conn->prepare($sql_sub);
  $stmt_sub->bind_param('i', $parent_id);
  $result_sub = $stmt_sub->execute();

  if (!$result_sub) {
    die($conn->error);
  }

  $result_sub = $stmt_sub->get_result();
  while ($row_sub = $result_sub->fetch_assoc()) {

    echo		"<div class='subcomment__block'>";
    echo			"<div class='subcomment__block--info mb-1 d-flex justify-content-between align-items-center'>";

    // 如果是使用者的留言，有編輯及刪除選單
    if ($row_sub['username'] === $username) {
      
      echo  "<div class='d-flex align-items-center'>";
      echo    "<span class='mb-0 card-title h6'>" . escape($row_sub['username']) ."</span>";
      
      // 如果子留言跟父留言為同個使用者
      if ($row['username'] === $row_sub['username']) {
        echo "<span class='origin'>樓主</span>";
      }
      echo  "</div>";
      echo  "<div class='dropdown dropleft'>";
      echo    "<button class='btn btn-sm dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'></button>";
      echo    "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
      echo      "<div class='comment__edit dropdown-item'>編輯</div>";
      echo      "<div class='comment__delete dropdown-item' data-id='". escape($row_sub['comm_id']) ."' data-type='subcomment'>刪除</div>";
      echo    "</div>";
      echo  "</div>";
  
    } else {
      echo  "<div class='d-flex align-items-center'>";
      echo    "<span class='mb-0 card-title h6'>" . escape($row_sub['username']) ."</span>";
      
      // 如果子留言跟父留言為同個使用者
      if ($row['username'] === $row_sub['username']) {
        echo "<span class='origin' >樓主</span>";
      }
      echo  "</div>";
    }

    echo	"</div>";
    echo  "<div class='subcomment__info--time mb-2'>" . escape($row_sub['time']) . "</div>";
  
    $text = sprintf(
      "<p class='subcomment__text' data-id='%d' parent-id='%d'>%s</p>",
      escape($row_sub['comm_id']),
      escape($row['comm_id']),
      escape($row_sub['text'])
    );
  
    echo  $text;
    echo  "<div class='like__area mb-2'>";

    // 未登入
    if (empty($_SESSION['username'])) { 
      echo  "<div data-toggle='tooltip' data-placement='bottom' title='登入後即可按讚'>";
      echo    "<svg width='1.3em' height='1.3em' viewBox='0 0 16 16' class='bi bi-heart like' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>";
      echo      "<path fill-rule='evenodd' d='M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z'/>";
      echo    "</svg>";
      echo  "</div>";

      // 有登入
    } else {

      // 確認有無按讚
      $liked = checkLiked($row_sub['comm_id'], $user_id);
      // 如果有按
      if ($liked) {
        echo    "<svg width='1.3em' height='1.3em' viewBox='0 0 16 16' class='bi bi-heart like hidden' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>";
        echo      "<path fill-rule='evenodd' d='M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z'/>";
        echo    "</svg>";
        echo    "<svg width='1.3em' height='1.3em' viewBox='0 0 16 16' class='bi bi-heart-fill liked' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>";
        echo      "<path fill-rule='evenodd' class='liked__heart' d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z'/>";
        echo    "</svg>";
      } else {
        echo    "<svg width='1.3em' height='1.3em' viewBox='0 0 16 16' class='bi bi-heart like' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>";
        echo      "<path fill-rule='evenodd' d='M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z'/>";
        echo    "</svg>";
        echo    "<svg width='1.3em' height='1.3em' viewBox='0 0 16 16' class='bi bi-heart-fill liked hidden' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>";
        echo      "<path fill-rule='evenodd' class='liked__heart' d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z'/>";
        echo    "</svg>";
      }
    }
    // 取得該留言讚數
    $likes = getLikes($row_sub['comm_id']);
    // 如果該留言有被按讚
    if ($likes > 0) {
      $like_text = sprintf(
        "<span class='liked__text' data='%d'>%d 人已按讚</span>",
        $likes,
        $likes
      );
      echo $like_text;
    }
    echo    "</div>";
    echo  "</div>";
  }
  echo	"</div>";
?>