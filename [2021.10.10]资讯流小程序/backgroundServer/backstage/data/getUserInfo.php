<?php
/* 用于获取展示的用户信息 */
$id = $_POST["id"];
include_once("../../api/database.php");
$str = "select * from user where id=$id";
$info = array();
$sth = $conn->prepare($str);
$sth->execute();
$res = $sth->fetch();
$info["id"]=$res["id"];
$info["name"]=$res["wxname"];
$info["avatar"]=$res["avatar"];
$info["pwd"]=$res["pwd"];
$info["gender"]=$res["gender"]==1?"男":"女";
$info["mail"]=$res["mail"];
echo json_encode($info);
?>