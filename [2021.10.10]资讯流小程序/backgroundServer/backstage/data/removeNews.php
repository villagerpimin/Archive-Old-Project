<?php
/* 用于删除新闻 */
$id=$_POST["id"];
include_once("../../api/database.php");
$del="delete from news where id=:id";
$sth=$conn->prepare($del);
$sth->execute(array(
    ":id"=>$id
));
echo $sth->rowCount();
?>