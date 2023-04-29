<?php
// 宣告這裡面的程式碼為 PHP 程式碼

// 首頁的功能
// 1. 判別是否登入，如果沒有登入，跳轉到登入介面
// 2. 如果有登入，查看留言列表

// // 測試資料庫是否有正常連線
// // 1. 宣告變數
// // 2. 連線到資料庫
// // 3. 確認連線狀態

// // 宣告變數
// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'user');
// define('DB_PASSWORD', 'testtest');
// define('DB_NAME', 'mydb');

// // 進行連線
// $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// // 確認狀態
// if ($link === false) {
//   die("ERROR: Could not connect. " . mysqli_connect_error());
// }
// // 確認連線成功
// echo "Connect Successfully. Host info: " . mysqli_get_host_info($link);


// 確認開啟 session
session_start();

// 首頁，確認是否登入，如果沒有登入，跳轉到登入介面
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
  // 跳轉到 login.php
  header("Location: login.php");
  exit;
}

// 構建新增留言

?>
<!-- 新增留言介面 -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>首頁</title>
    </head>
    <body>
        <h1>歡迎 <?php echo $_SESSION['username']; ?></h1>
        <b>新增留言</b>
        <form method="POST" action="index.php">
        <!-- textarea -->
        <textarea name="content" placeholder="請輸入留言"></textarea>
            <!-- <input type="text" name="content" placeholder="請輸入留言"> -->
            <input type="submit" value="新增">
        </form>
    </body>
</html>


