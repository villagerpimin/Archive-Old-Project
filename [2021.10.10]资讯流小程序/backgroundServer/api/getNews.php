<?php
include_once("database.php");
/* 获取新闻内容 */
$nid=$_POST["nid"];  //获得新闻id
$str = "select * from news where id = $nid";
$contadd = "update news set watched = watched+1 where id = $nid";
/* 阅读数加1 */
$cont=$conn->query($contadd);
/* 获得新闻并返回 */
$res = $conn->prepare($str);
$res->execute();
$data=$res->fetch();
$content=array(
    "img"=>$data["image"],
    "title"=>$data["title"],
    "content"=>$data["content"],
    "author"=>$data["author"],
    "date"=>$data["news_date"]
);
echo json_encode($content);
?>