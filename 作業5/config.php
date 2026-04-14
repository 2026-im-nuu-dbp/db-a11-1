<?php
session_start();

$dbName = "testdb";

// Connect first without selecting a database, so we can create it if missing.
$conn = new mysqli("localhost", "root", "", "");
if ($conn->connect_error) {
    die("DB Error");
}

$conn->query("CREATE DATABASE IF NOT EXISTS `{$dbName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
$conn->select_db($dbName);
$conn->set_charset("utf8mb4");

// Ensure required tables exist so pages can run without manual SQL import.
$conn->query("CREATE TABLE IF NOT EXISTS dbusers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    nickname VARCHAR(50),
    password VARCHAR(255),
    gender VARCHAR(10),
    hobbies TEXT
)");

$conn->query("CREATE TABLE IF NOT EXISTS dblog (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    login_time DATETIME,
    success BOOLEAN
)");

$conn->query("CREATE TABLE IF NOT EXISTS dememo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    content TEXT,
    image VARCHAR(255)
)");
