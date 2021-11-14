<?php
/* 用于返回请求的轮播图信息 */
$bid = @$_POST["bid"];
include_once("../../api/database.php");
$str = "select * from banner where id=:bid";
$sth = $conn->prepare($str);
$sth->execute(array(":bid"=>$bid));
$bres = $sth->fetchObject();
$datalist = array(
    "title"=>$bres->banner_title,
    "img"=>$bres->banner_image,
    "nid"=>$bres->nid
); /* 用于返回的数据 */
echo json_encode($datalist);
?>