<?php
// 註冊頁面
// 輸入帳號跟密碼+註冊按鈕 --> HTML 實作
// 跟資料庫互動 --> PHP 實作

// 登入成功之後，要跳轉到首頁
session_start();
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

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

    // 寫入資料庫
    // 1. 準備 SQL 語法
    // 2. 執行
    // 3. 確認是否寫入成功

    // 準備 SQL 語法 ==> 不安全的寫法
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    echo $sql;
    // 執行
    if (mysqli_query($link, $sql)) {
        echo "註冊成功";
    } else {
        echo "註冊失敗";
    }
}


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
