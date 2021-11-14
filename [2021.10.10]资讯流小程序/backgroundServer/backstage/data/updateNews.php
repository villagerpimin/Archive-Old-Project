<?php
/* 用于更新新闻 */
$author = isset($_POST["author"])?$_POST["author"]:"admin";
$tag = $_POST["tag"]!=""?$_POST["tag"]:null;
$title = $_POST["title"];
$img = $_POST["img"];
$content = $_POST["content"];
$id = $_POST["nid"];
$date = date("Y-m-d");
include_once("../../api/database.php");
$str = "update news set tag=:tag,title=:title,content=:content,image=:image,author=:author,news_date=:date".
    " where id=:nid";
$sth=$conn->prepare($str);
$sth->execute(array(
    ":tag"=>$tag,
    ":title"=>$title,
    ":content"=>$content,
    ":image"=>"http://localhost:782/uni/img/$img",
    ":author"=>$author,
    ":date"=>$date,
    ":nid"=>$id
));
echo $sth->rowCount();
?>