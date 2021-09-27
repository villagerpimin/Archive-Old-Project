<?php
    //用于检查验证码是否正确
    session_start();
    $ssend=$_POST['pcode'];
    if($ssend==$_SESSION['code']){
        echo "true";
    }
    else{
        echo "false";
    }
?>