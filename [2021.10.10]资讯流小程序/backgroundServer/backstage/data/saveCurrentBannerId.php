<?php
/* 以一种船新的方式设置轮播图 */
$nid = @$_POST["nowid"];
include_once("../../api/database.php");
$str = "select * from news where id=$nid";
$sth = $conn->prepare($str);
$sth->execute();
$data = $sth->fetchObject();
$title = $data->title;
$img = $data->image;

$str2 = "insert into banner(banner_title,banner_image,nid) values('$title','$img','$nid')";
$sth2 = $conn->prepare($str2);
$sth2->execute();
echo $sth2->rowCount();
?>