<?php
session_start();
session_destroy();
echo "已登出，<a href='login.php'>返回登入</a>";

