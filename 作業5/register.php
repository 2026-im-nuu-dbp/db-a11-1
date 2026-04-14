<?php include "config.php"; ?>
<!doctype html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <title>註冊</title>
</head>

<body>
    <a href="index.php">首頁</a> |
    <a href="login.php">前往登入</a><br><br>

    <form method="POST">
        帳號:<input name="username" required><br>
        暱稱:<input name="nickname" required><br>
        密碼:<input type="password" name="password" required><br>
        性別:
        <select name="gender">
            <option value="male">male</option>
            <option value="female">female</option>
        </select><br>
        興趣:<input name="hobbies"><br>
        <button type="submit">註冊</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pw = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO dbusers(username,nickname,password,gender,hobbies) VALUES(?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $_POST['username'], $_POST['nickname'], $pw, $_POST['gender'], $_POST['hobbies']);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        } else {
            echo "註冊失敗：" . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8');
        }
    }
    ?>
</body>

</html>