<?php
/* 获得新闻信息 */
$author = isset($_POST["author"])?$_POST["author"]:"admin";
$tag = isset($_POST["tag"])?$_POST["tag"]:null;
$title = $_POST["title"];
$img = $_POST["img"];
$content = $_POST["content"];
$date = date("Y-m-d");
/* 上传到数据库 */
include_once("../../api/database.php");
$str = "insert into news(tag,title,content,image,author,news_date) ".
    "values(:tag,:title,:content,:image,:author,:date)";
$sth=$conn->prepare($str);
$sth->execute(array(
    ":tag"=>$tag,
    ":title"=>$title,
    ":content"=>$content,
    ":image"=>"http://localhost:782/uni/img/$img",
    ":author"=>$author,
    ":date"=>$date
));
echo $sth->rowCount();
?>