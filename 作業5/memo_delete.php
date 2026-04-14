<?php
include "config.php";

if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $conn->prepare("DELETE FROM dememo WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $id, $_SESSION['uid']);
$stmt->execute();

header("Location: memo_list.php");
exit;
