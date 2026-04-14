CREATE TABLE dbusers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    nickname VARCHAR(50),
    password VARCHAR(255),
    gender VARCHAR(10),
    hobbies TEXT
);
