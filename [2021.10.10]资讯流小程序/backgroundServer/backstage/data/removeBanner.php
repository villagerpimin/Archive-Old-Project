<?php
/* 用于删除轮播图 */
$bid = @$_POST["bid"];
include_once("../../api/database.php");
$str = "delete from banner where id=:bid";
$sth = $conn->prepare($str);
$sth->execute(array(":bid"=>$bid));
echo $sth->rowCount();
?>