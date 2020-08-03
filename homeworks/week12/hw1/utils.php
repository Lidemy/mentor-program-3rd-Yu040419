<?php
require_once('conn.php');

 // 製造亂碼
function getToken() {
  $str = '';
  for($i = 1; $i <= 16; $i += 1) {
    $str .= chr(rand(65,90));
  }
  return $str;
}

// 透過 token 拿到 user 資料
function getUserFromToken($token) {
  global $conn;
  $sql = "SELECT yu_users.id, yu_users.nickname, yu_users.username, yu_users_certificates.token 
    FROM yu_users JOIN yu_users_certificates ON yu_users.username = yu_users_certificates.username 
    WHERE yu_users_certificates.token = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $token);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }

  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  return $row;
}

// XSS
function escape($str) {
  return htmlspecialchars($str, ENT_QUOTES);
}

// alert 訊息後轉址
function alert($message, $redirect) {
  $alert = sprintf(
    'alert("%s");',
    $message
  );
  $location = sprintf(
    'window.location.href = "%s";',
    $redirect
  );
  echo '<script>';
  echo $alert;
  echo $location;
  echo '</script>';
}

// 目前想到的方法感覺很迂迴，先到一個檔案確認後再轉址到刪除留言的檔案
function confirm($message, $id) {
  $if = sprintf(
    'if (confirm("%s")) {',
    $message
  );

  $url = sprintf(
    'let url = new URL("http://localhost/check_delete.php?id=%d");',
    $id
  );

  echo '<script>';
  echo   $url; 
  echo   'let params = url.searchParams;'; 
  echo   $if;
  echo     'params.append("delete", "yes");';
  echo     'window.location.href = `./handle_delete_comment.php?${params.toString()}`';
  echo   '} else {';
  echo     'window.history.back();';
  echo   '}';
  echo '</script>';

}

// 回到兩頁前
function lastPage() {
  echo '<script language=JavaScript>';
  // 在自己的電腦上跑可以會直接重整，但不知道為什麼放在遠端伺服器需要再重整一次
  echo   'history.back(-2);';
  echo '</script>';
}
?>