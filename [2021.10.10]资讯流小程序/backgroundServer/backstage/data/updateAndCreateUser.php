<?php
/* 用于创建或修改用户 */
$type = $_POST["type"];
$mail = @$_POST["mail"];
$nickname = @$_POST["nickname"];
$img = !empty($_POST["img"])?"http://localhost:782/uni{$_POST['img']}":null;
$sex = $_POST["sex"]=="男"?"1":"0";
$pwd = @$_POST["pwd"];
$uid = @$_POST["uid"];
include_once("../../api/database.php");
$str = "";
$data=array(
    ":name"=>$nickname,
    ":img"=>$img,
    ":pwd"=>$pwd,
    ":sex"=>$sex,
    ":mail"=>$mail
);
if($type=="new"){
    /* 新建用户 */
    $str = "insert into user(wxname,avatar,pwd,gender,mail) values(:name,:img,:pwd,:sex,:mail)";
}
else{
    /* 修改用户 */
    $str = "update user set wxname=:name,avatar=:img,pwd=:pwd,gender=:sex,mail=:mail where id=:id";
    $data[":id"]=$uid;
}
$sth = $conn->prepare($str);
$sth->execute($data);
echo $sth->rowCount();
?>