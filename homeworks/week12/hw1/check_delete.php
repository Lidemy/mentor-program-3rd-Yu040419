<?php
  require_once('conn.php');
  include_once('utils.php');

  if (!isset($_GET['id'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }
  
  $comment_id = $_GET['id'];
  confirm('確定要刪除嗎？', $comment_id);
?>
