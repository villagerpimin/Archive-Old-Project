<?php
    /* 用于提交更新 */
    include('../connect.php');
    //upcno 课程号,upcname 课程名,upcredit 学时,upctea 任课教师
    //upctime 上课时间,upclimt 限制人数,upckind 课程类型,upcdepart 所属院系
    $upSql=sprintf("update course set CouName='%s',Kind='%s',Credit=%s,
        Teacher='%s',DepartNo='%s',SchoolTime='%s',LimitNum=%s where CouNo='%s'",
        $_POST['upcname'],$_POST['upckind'],$_POST['upcredit'],$_POST['upctea'],
        $_POST['upcdepart'],$_POST['upctime'],$_POST['upclimt'],$_POST['upcno']);
    $upRes=mysqli_query($conn,$upSql);
    if($upRes){ //成功时返回success
        echo "success";
    }
    else{
        echo "修改失败，可能表中含有相同数据";
        echo mysqli_error($conn);
    }
?>