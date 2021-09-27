<?php
    /* 用于删除已选的指定课程 */
    include("../connect.php");
    $delNo=$_POST['dcno'];/* 获得要删除的课程号 */
    $sno=$_POST['sno']; //获得要删除课程的学号
    $sql="delete from stucou where CouNo=$delNo and StuNo=$sno";
    $result=mysqli_query($conn,$sql);
    if($result){ //删除成功(有值)
        echo "success";
    }
    else{
        echo "error";
    }
?>