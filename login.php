<?php
// 登入介面
// 登入表單 --> HTML 實作
// 登入的邏輯 + 資料庫互動 --> PHP 實作

session_start(); // 加入 Session 機制
// 資料庫連線
// 測試資料庫是否有正常連線
// 1. 宣告變數
// 2. 連線到資料庫
// 3. 確認連線狀態


// 不安全的寫法
// // 宣告變數
// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'user');
// define('DB_PASSWORD', 'testtest');
// define('DB_NAME', 'mydb');

// // 進行連線
// $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// // 確認狀態
// if ($link === false) {
//     die("ERROR: Could not connect. " . mysqli_connect_error());
// }

// // 接受表單資料，確認請求的方法是否為 POST
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // 取得表單資料
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     // 確認帳號密碼是否為空
//     if (empty($username) || empty($password)) {
//         echo "帳號密碼不得為空";
//     } else {
//         // 帳號密碼不為空，確認帳號密碼是否正確
//         // 1. 準備 SQL 語法
//         $sql = "SELECT id, username, password FROM users WHERE username = '$username' and password = '$password'";
//         echo $sql;
//         // 2. 執行
//         $result = mysqli_query($link, $sql);
//         // 3. 確認是否正確
//         if (mysqli_num_rows($result) == 1) {
//             // 取得會員資料
//             $row = mysqli_fetch_assoc($result);
//             $id = $row['id'];
            
//             // 登入成功
//             // echo "登入成功";
//             // 設定 Session
//             // $_SESSION 全域變數，用來儲存 Session 資料
//             // username 是 Session 名稱，$username 是 Session 值
//             $_SESSION['username'] = $username;
//             $_SESSION['id'] = $id;
//             // 跳轉到 index.php
//             header("Location: index.php");

//         } else {
//             // 登入失敗
//             echo "登入失敗";
//         }
//     }

// }


// 安全的寫法
// 參數化跟資料庫互動，不要用字串串接的方式
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // 安全：取得表單的帳號，進行過濾
  $account = filter_input(INPUT_POST, 'account', FILTER_SANITIZE_STRING);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

  // 安全寫法，使用 prepared statement
  $mysqli = new mysqli("localhost", "user", "testtest", "mydb");

  $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ? AND password = ? ");
  $stmt->bind_param("ss", $account, $password);
  $stmt->execute();
  $stmt->bind_result($user_id, $user_name, $user_password);

  // 獲取使用者資料
  $stmt->fetch();
  
  //確認是否登入失敗
  if ($user_id == null) {
    die('登入失敗');
  }

  $_SESSION['username'] = $user_name;
  $_SESSION['id'] = $user_id;

  // 重定向到首頁
  header('Location: index.php');

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
