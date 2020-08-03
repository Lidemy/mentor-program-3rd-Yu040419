<?php
  require_once('conn.php');
  include_once('utils.php');

  if (empty($_COOKIE['token'])) { ?>
    <a class='navbar__member--login' href='./login.php' >登入</a>
    <a class='navbar__member--register' href='./register.php' >註冊</a>
  <?php
  } else {
    $token = $_COOKIE['token'];
    $user = getUserFromToken($token);
    $nickname = $user['nickname'];
    $username = $user['username']; ?>
      
    <a class='navbar__member--name' href='./profile.php'><?php echo escape($nickname) ?></a>
    <a class='navbar__member--logout' href='./handle_logout.php' >登出</a>
  <?php
  }
?>
