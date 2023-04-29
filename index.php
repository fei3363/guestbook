<?php
// 宣告這裡面的程式碼為 PHP 程式碼

// 首頁的功能
// 1. 判別是否登入，如果沒有登入，跳轉到登入介面
// 2. 如果有登入，查看留言列表

// // 測試資料庫是否有正常連線
// // 1. 宣告變數
// // 2. 連線到資料庫
// // 3. 確認連線狀態

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

// 構建新增留言，確認是否為 POST 請求，以及 content 是否有內容
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 取得表單資料
    $content = $_POST['content'];
    // 確認 content 是否為空
    if (empty($content)) {
        echo "留言不得為空";
    } else {
        // 留言不為空，新增留言
        $id = $_SESSION['id'];
        // 1. 準備 SQL 語法
        $sql = "INSERT INTO messages (user_id, message) VALUES ('$id', '$content')";
        // 2. 執行
        $result = mysqli_query($link, $sql);
        // 3. 確認是否正確
        if ($result) {
            // 新增成功，跳轉到 index.php
            header("Location: index.php");
        } else {
            // 新增失敗
            echo "新增失敗";
        }

    }
}

?>
<!-- 新增留言介面 -->
<html>

<head>
    <meta charset="UTF-8">
    <title>首頁</title>
</head>

<body>
    <h1>歡迎
        <?php echo $_SESSION['username']; ?>
    </h1>
    <b>新增留言</b>
    <form method="POST" action="index.php">
        <!-- textarea -->
        <textarea name="content" placeholder="請輸入留言"></textarea>
        <!-- <input type="text" name="content" placeholder="請輸入留言"> -->
        <input type="submit" value="新增">
    </form>

    <!-- 留言列表 -->
    <h2>留言列表</h2>
    <?php
    // 1. 準備 SQL 語法
    // $sql = "SELECT * FROM messages";
    // 想知道 user_id 是誰，要去 users 資料表查詢
    $sql = "SELECT messages.*, users.username FROM messages JOIN users ON messages.user_id = users.id";

    // 2. 執行
    $result = mysqli_query($link, $sql);
    // 3. 確認是否正確
    if ($result) {
        // 4. 確認是否有資料
        if (mysqli_num_rows($result) > 0) {
            // 5. 有資料，取得資料並顯示
            while ($row = mysqli_fetch_array($result)) {
                // 顯示作者是誰，作者的留言是什麼
                echo $row['username'] . ": ";
                echo $row['message'] . "<br>";
            }
        } else {
            // 6. 沒有資料，顯示沒有資料
            echo "沒有資料";
        }
    } else {
        // 7. 錯誤處理
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    ?>

</body>

</html>
