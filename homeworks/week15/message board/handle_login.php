<?php
  session_start();
  require_once('conn.php');
  include_once('utils.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username) || empty($password)) {
    echo json_encode(array(
      'OK' => false,
      'message' => '請完整輸入帳號及密碼'
    ));
    exit();
  }

  $sql =  "SELECT * FROM yu_users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);
  $result = $stmt->execute();

  if (!$result) {
    echo json_encode(array(
      'OK' => false,
      'message' => '登入失敗，請稍後再試一次'
    ));
    exit();
  }

  $result = $stmt->get_result();
  if ($result->num_rows === 0) {
    echo json_encode(array(
      'OK' => false,
      'message' => '帳號或密碼輸入錯誤'
    ));
    exit();
  }

  $row = $result->fetch_assoc();
  $salted_password = $password . $row['salt'];
  if (password_verify($salted_password, $row['password'])) {
    $_SESSION['username'] = $username;
    
    /*
    不知道為什麼以下的 code 執行後沒有辦法成功設定 cookie，
    打開 dev tool 看 cookie 詳細資料，在 samesite 跟 httponly 都沒有顯示

    $maxlifetime = time() + 3600 * 24 * 7; // 一周
    $secure = false; // gandi 提供的網域目前是 http 不是 https 所以暫時使用 false
    $httponly = true; // prevent JavaScript access to session cookie
    $samesite = 'lax';
  
    if (PHP_VERSION_ID < 70300) {
      session_set_cookie_params($maxlifetime, '/; samesite='.$samesite, $_SERVER['HTTP_HOST'], $secure, $httponly);
    } else {
      session_set_cookie_params([
          'lifetime' => $maxlifetime,
          'path' => '/',
          'domain' => $_SERVER['HTTP_HOST'],
          'secure' => $secure,
          'httponly' => $httponly,
          'samesite' => $samesite
      ]);
    }

    以上來源：https://www.php.net/manual/en/function.session-set-cookie-params.php#125072
    */
    echo json_encode(array(
      'OK' => true,
      'message' => '登入成功'
    ));
  } else {
    echo json_encode(array(
      'OK' => false,
      'message' => '帳號或密碼輸入錯誤'
    ));
  }
?>
