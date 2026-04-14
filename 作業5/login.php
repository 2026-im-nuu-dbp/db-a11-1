<?php include "config.php"; ?>
<!doctype html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <title>登入</title>
</head>

<body>
    <a href="index.php">首頁</a> |
    <a href="register.php">前往註冊</a><br><br>

    <form method="POST">
        帳號:<input name="username" required><br>
        密碼:<input type="password" name="password" required><br>
        <button type="submit">登入</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql = "SELECT * FROM dbusers WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        $success = 0;
        if ($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['uid'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $success = 1;
        }

        $logStmt = $conn->prepare("INSERT INTO dblog(username,login_time,success) VALUES(?,NOW(),?)");
        $logStmt->bind_param("si", $_POST['username'], $success);
        $logStmt->execute();

        if ($success) {
            header("Location: memo_list.php");
            exit;
        }

        echo "登入失敗";
    }
    ?>
</body>

</html>