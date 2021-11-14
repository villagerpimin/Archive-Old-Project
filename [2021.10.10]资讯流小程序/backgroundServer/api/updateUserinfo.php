<?php
/* 用于用户信息的更新 */
$userData=$_POST["update"];
$userData=json_decode($userData);

include_once("database.php");
/* 将用户数据更新 */
$update="update user set wxname=:name,avatar=:avatar,gender=:gender,mail=:mail where openid=:openid";
$sth = $conn->prepare($update);
$res = $sth->execute(array(
    ":name"=>$userData->name,
    ":avatar"=>$userData->avatar,
    ":gender"=>$userData->gender,
    ":openid"=>$userData->openid,
    ":mail"=>$userData->mail
));
/* 返回状态 */
if($res){
    echo true;
}
else{
    echo false;
}
?>