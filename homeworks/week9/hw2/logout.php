<?php
require_once('conn.php');

setcookie("nickname", "", time() - 3600);
setcookie("username", "", time() - 3600);

header('Location: index.php');
?>