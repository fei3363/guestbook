<?php
// 登出
session_start();
session_destroy();
header('Location: /guestbook/login.php');
?>
