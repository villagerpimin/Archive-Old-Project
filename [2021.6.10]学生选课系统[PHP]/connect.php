<?php
    /* 用于连接数据库 */
    $conn=mysqli_connect('localhost','root','123','exam2') or die("数据库连接失败！");
    mysqli_set_charset($conn,'utf8');
?>