<?php
/* 连接数据库 */
$str = "mysql:host=localhost;port=3306;charset=utf8mb4;dbname=jianyue_news";
$conn = new PDO($str,"root","") or die("连接数据库失败");
?>