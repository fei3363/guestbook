<?php 
// 註冊頁面
// 輸入帳號跟密碼+註冊按鈕 --> HTML 實作
// 跟資料庫互動 --> PHP 實作

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>註冊</title>
    </head>
    <body>
        <h1>註冊</h1>
        <form method="POST" action="signup.php">
        <div>帳號: <input name="username" type="text"></div>
        <div>密碼: <input name="password" type="password"></div>
        <input type="submit" value="註冊">
        </form>
    </body>
</html>
