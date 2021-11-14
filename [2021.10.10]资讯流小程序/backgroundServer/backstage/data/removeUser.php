<?php
/* 用于删除用户 */
$id = $_POST["id"];
include_once("../../api/database.php");
$str = "delete from user where id=:id";
$sth = $conn->prepare($str);
$sth->execute(array(
    ":id"=>$id
));
echo $sth->rowCount();
?>