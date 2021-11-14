<?php
include_once("../../api/database.php");
$name = $_POST["name"];
$pwd = $_POST["pwd"];
$str = "select * from admin where uname=:name and upwd=:pwd";
$sth = $conn->prepare($str);
$sth->execute(array(
    ":name"=>$name,
    ":pwd"=>$pwd
));
$res = $sth->fetchObject();

if(!empty($res->id)){
    /* 如果有数据，向数据库更新最后登录日期 */
    $update="update admin set last_date=:date where uname=:name and upwd=:pwd";
    date_default_timezone_set("PRC");  //设置时区
    $date=date("Y-m-d H:i:s");
    $sth = $conn->prepare($update);
    $sth->execute(array(
        ":date"=>$date,
        ":name"=>$name,
        ":pwd"=>$pwd
    ));
    if($sth->rowCount()!=0){
        session_start();
        $_SESSION["name"]=$name;
        echo "ok";
        die(); //运行结束
    }
}
echo false;
?>