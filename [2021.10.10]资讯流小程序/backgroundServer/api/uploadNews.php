<?php
/* 用于上传新闻到审核区 */
$img = @$_FILES["img"];
$title = @$_POST["title"];
$tag = @$_POST["tag"];
$content = @$_POST["content"];
$author = @$_POST["author"];
$uid = @$_POST["uid"];

/* 将图片保存到本地 */
$filename = time().".".substr($img['type'],6,strlen($img['type']));
$path =  $img["tmp_name"];
$newpath = "../img/$filename";
move_uploaded_file($path,$newpath);


/* 将数据保存到数据库 */
include_once("./database.php");
$img_network_path="http://localhost:782/uni/img/$filename";
$date = date("Y-m-d");
$str = "insert into news_cache(title,content,image,author,news_date,status,uid,tag) values(:title,:content,:img,".
    ":author,:news_date,'待审核',:uid,:tag)";
$sth = $conn->prepare($str);
$sth->execute(array(
    ":title"=>$title,
    ":content"=>$content,
    ":author"=>$author,
    ":news_date"=>$date,
    ":img"=>$img_network_path,
    ":uid"=>$uid,
    ":tag"=>$tag
));
echo $sth->rowCount();
?>