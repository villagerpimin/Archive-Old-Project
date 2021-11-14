<?php
/* 用于更新或新建轮播图 */
$type = @$_POST["type"];
$nid = @$_POST["nid"];
$title = @$_POST["title"];
$img = !empty($_POST["img"])?"http://localhost:782/uni/img/banner/{$_POST['img']}":null;
include_once("../../api/database.php");
$str="";
if($type=="add"){
    $str="insert into banner(banner_title,banner_image,nid) values(:title,:img,:nid)";
}else{
    $id = @$_POST["bid"];
    $str="update banner set banner_title=:title,banner_image=:img,nid=:nid where id=$id";
}
$sth = $conn->prepare($str);
$sth->execute(array(
    ":title"=>$title,
    ":img"=>$img,
    ":nid"=>$nid
));
echo $sth->rowCount();
echo $conn->errorInfo();
?>