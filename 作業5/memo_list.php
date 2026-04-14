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
    <title>備忘列表</title>
</head>

<body>
    <a href="index.php">首頁</a> |
    <a href="memo_add.php">新增</a> |
    <a href="log_view.php">查看log</a> |
    <a href="logout.php">登出</a><br><br>

    <?php
    $stmt = $conn->prepare("SELECT * FROM dememo WHERE user_id=? ORDER BY id DESC");
    $stmt->bind_param("i", $_SESSION['uid']);
    $stmt->execute();
    $res = $stmt->get_result();

    while ($row = $res->fetch_assoc()) {
        echo nl2br(htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8')) . "<br>";
        if (!empty($row['image'])) {
            echo "<img src='" . htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8') . "' width='100'><br>";
        }
        echo "<a href='memo_delete.php?id=" . (int)$row['id'] . "'>刪除</a><hr>";
    }

    if ($res->num_rows === 0) {
        echo "目前沒有備忘資料。";
    }
    ?>
</body>

</html>