<?php
// 登入介面
// 登入表單 --> HTML 實作
// 登入的邏輯 + 資料庫互動 --> PHP 實作

// 資料庫連線
// 測試資料庫是否有正常連線
// 1. 宣告變數
// 2. 連線到資料庫
// 3. 確認連線狀態

// 宣告變數
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'user');
define('DB_PASSWORD', 'testtest');
define('DB_NAME', 'mydb');

// 進行連線
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// 確認狀態
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// 接受表單資料，確認請求的方法是否為 POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 取得表單資料
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 確認帳號密碼是否為空
    if (empty($username) || empty($password)) {
        echo "帳號密碼不得為空";
    } else {
        // 帳號密碼不為空，確認帳號密碼是否正確
        // 1. 準備 SQL 語法
        $sql = "SELECT id, username, password FROM users WHERE username = '$username' and password = '$password'";
        // 2. 執行
        $result = mysqli_query($link, $sql);
        // 3. 確認是否正確
        if (mysqli_num_rows($result) == 1) {
            // 登入成功
            echo "登入成功";
        } else {
            // 登入失敗
            echo "登入失敗";
        }
    }

}

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
