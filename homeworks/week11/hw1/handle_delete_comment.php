<?php
  require_once('conn.php');
  require_once('utils.php');

  $comment_id = $_GET['id'];

  if (empty($comment_id)) {
    header('Location: .php?errcode=4');
    exit();
  }

  $sql =  "UPDATE yu_comments SET is_deleted = 1 WHERE comm_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $comment_id);
  $result = $stmt->execute();

  if(!$result) {
    die($conn->error);
  } else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>
