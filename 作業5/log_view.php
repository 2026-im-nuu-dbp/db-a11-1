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
    <title>登入紀錄</title>
</head>

<body>
    <a href="index.php">首頁</a> |
    <a href="memo_list.php">備忘列表</a> |
    <a href="logout.php">登出</a><br><br>

    <?php
    echo "<h3>登入次數統計</h3>";
    echo "<table border='1' cellpadding='6' cellspacing='0'>";
    echo "<tr><th>帳號</th><th>登入次數</th></tr>";

    $summary = $conn->query("SELECT username, COUNT(*) AS login_count FROM dblog GROUP BY username ORDER BY login_count DESC, username ASC");
    $hasSummary = false;
    while ($row = $summary->fetch_assoc()) {
        $hasSummary = true;
        echo "<tr><td>" . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "</td><td>" . (int)$row['login_count'] . "</td></tr>";
    }
    if (!$hasSummary) {
        echo "<tr><td colspan='2'>目前沒有登入紀錄</td></tr>";
    }
    echo "</table>";

    echo "<h3>每次登入時間</h3>";
    $res = $conn->query("SELECT * FROM dblog ORDER BY username ASC, login_time DESC, id DESC");
    $currentUser = null;
    $hasDetail = false;

    while ($row = $res->fetch_assoc()) {
        $hasDetail = true;
        if ($currentUser !== $row['username']) {
            if ($currentUser !== null) {
                echo "</ul>";
            }
            $currentUser = $row['username'];
            echo "<h4>" . htmlspecialchars($currentUser, ENT_QUOTES, 'UTF-8') . "</h4>";
            echo "<ul>";
        }

        echo "<li>" . htmlspecialchars($row['login_time'], ENT_QUOTES, 'UTF-8') . " - " . ($row['success'] ? "成功" : "失敗") . "</li>";
    }

    if ($currentUser !== null) {
        echo "</ul>";
    }
    if (!$hasDetail) {
        echo "目前沒有登入時間紀錄";
    }
    ?>
</body>

</html>