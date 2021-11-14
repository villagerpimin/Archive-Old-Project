<?php
/* 用于执行对tag的操作 */
$type = $_POST["type"];
$tag = @$_POST["tag"];
$id = @$_POST["tid"];
include_once("../../api/database.php");
$str = "";$arr=array();
if($type=="del"){
    $str = "delete from tags where id=:id";
    $arr[":id"]=$id;
}else if($type=="create"){
    $str = "insert into tags(tag) values(:tag)";
    $arr[":tag"]=$tag;
}else{
    $str = "update tags set tag=:tag where id=:id";
    $arr[":tag"]=$tag;
    $arr[":id"]=$id;
}
$sth = $conn->prepare($str);
$sth->execute($arr);
echo $sth->rowCount();
?>