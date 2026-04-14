<?php include "config.php"; ?>
<?php
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit;
}
?>
<!doctype html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <title>新增備忘</title>
</head>

<body>
    <a href="index.php">首頁</a> |
    <a href="memo_list.php">返回列表</a> |
    <a href="logout.php">登出</a><br><br>

    <form method="POST" enctype="multipart/form-data">
        內容:<textarea name="content" required></textarea><br>
        圖片:<input type="file" name="img" accept="image/*"><br>
        <button type="submit">新增</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $file = "";
        if (!empty($_FILES['img']['name']) && is_uploaded_file($_FILES['img']['tmp_name'])) {
            $safeName = preg_replace('/[^A-Za-z0-9._-]/', '_', basename($_FILES['img']['name']));
            $file = "uploads/" . time() . "_" . $safeName;
            move_uploaded_file($_FILES['img']['tmp_name'], $file);
        }

        $stmt = $conn->prepare("INSERT INTO dememo(user_id,content,image) VALUES(?,?,?)");
        $stmt->bind_param("iss", $_SESSION['uid'], $_POST['content'], $file);
        $stmt->execute();

        echo "<p>新增成功，<a href='memo_list.php'>查看列表</a></p>";
    }
    ?>
</body>

</html>