<?php
session_start();
$ssend=$_POST["code"]; //获取发送的内容
if($ssend===$_SESSION["code_ver"]){ //对比，正确返回true
    echo true;
}
?>