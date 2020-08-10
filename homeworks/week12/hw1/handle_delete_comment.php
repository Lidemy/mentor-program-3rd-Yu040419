<?php
  require_once('conn.php');
  include_once('utils.php');
?>

<?php

    if (empty($_GET['id']) || $_GET['delete'] !== 'yes') {
      alert('抱歉有問題，請稍後再試', $_SERVER['HTTP_REFERER']);
    }


    $comment_id = $_GET['id'];
    $parent_id = $_GET['id'];


    if (!empty($_COOKIE['token'])) {
      $token = $_COOKIE['token'];
      $user = getUserFromToken($token);
      $user_id = $user['id'];
    }

    $sql =  "UPDATE yu_comments SET is_deleted = 1 
      WHERE comm_id = ? AND user_id = ? OR parent_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $comment_id, $user_id, $parent_id);
    $result = $stmt->execute();

    if(!$result) {
      die($conn->error);
    } else {
      lastPage();
    }

?>
