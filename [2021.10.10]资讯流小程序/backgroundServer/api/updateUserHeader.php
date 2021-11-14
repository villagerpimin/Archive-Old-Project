<?php
/* 用于更改用户头像 */
$img = $_FILES["img"];
$openid = $_POST["openid"];

/* 将图片存到本地 */
$path = $img["tmp_name"];
$type = substr($img['type'],6,strlen($img['type']));
$filename = md5(time()+mt_rand(0,100)).".".$type;
$newpath = "../img/user/$filename";
move_uploaded_file($path,$newpath);

/* 修改数据库数据 */
include_once("./database.php");
$str = "update user set avatar=:img where openid=:openid";
$sth = $conn->prepare($str);
$sth->execute(array(
    ":img"=>"http://localhost:782/img/user/$filename",
    ":openid"=>$openid
));
echo $sth->rowCount();
?>