<?php
// 登入介面
// 登入表單 --> HTML 實作
// 登入的邏輯 + 資料庫互動 --> PHP 實作

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>登入</title>
    </head>
    <body>
        <h1>登入</h1>
        <form method="POST" action="login.php">
            <div>帳號: <input name="username" type="text"></div>
            <div>密碼: <input name="password" type="password"></div>
            <input type="submit" value="登入">
        </form>
    </body>
</html>
