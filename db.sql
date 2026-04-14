CREATE TABLE dbusers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    nickname VARCHAR(50),
    password VARCHAR(255),
    gender VARCHAR(10),
    hobbies TEXT
);

CREATE TABLE dblog (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    login_time DATETIME,
    success BOOLEAN
);

CREATE TABLE dememo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    content TEXT,
    image VARCHAR(255)
);