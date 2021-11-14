<?php
/* 用于更新新闻的按赞数 */
$pid = $_POST["pid"];
$type = $_POST["type"];
include_once("./database.php");
$str = "";
if($type=="good"){
    /* 点赞 */
    $str = "update comment set good=good+1 where id=:pid";
    
}else{
    /* 点踩 */
    $str = "update comment set good=good-1 where id=:pid";
}
$sth = $conn->prepare($str);
$sth->execute(array(
    ":pid"=>$pid
));
echo $sth->rowCount();
?>