<?php include "config.php"; ?>
<!doctype html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <title>作業5 系統入口</title>
</head>

<body>
    <h2>作業5 系統入口</h2>

    <?php if (isset($_SESSION['uid'])): ?>
        <p>目前登入帳號：<?php echo htmlspecialchars($_SESSION['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
        <a href="memo_list.php">進入備忘列表</a> |
        <a href="memo_add.php">新增備忘</a> |
        <a href="log_view.php">查看登入紀錄</a> |
        <a href="logout.php">登出</a>
    <?php else: ?>
        <a href="register.php">註冊</a> |
        <a href="login.php">登入</a>
    <?php endif; ?>
</body>

</html>