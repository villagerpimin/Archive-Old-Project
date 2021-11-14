<?php
/* 用于发表评论 */
$val = $_POST["val"];
$openid = $_POST["openid"];
$newsid = $_POST["newsid"];
$date = date("Y-m-d");
include_once("./database.php");
$str = "insert into comment(openid,newsid,content,post_date,good) values(:openid,:newsid,:content,:post_date,0)";
$sth = $conn->prepare($str);
$sth->execute(array(
    ":openid"=>$openid,
    ":newsid"=>$newsid,
    ":content"=>$val,
    ":post_date"=>$date
));
echo $sth->rowCount();
?>