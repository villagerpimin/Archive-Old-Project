<?php
    /* 用于返回教师端删除课程的警告信息 */
    include("../WillCount.php");
    include("../connect.php");
    $delId=$_POST['delid']; //获得要删除的课程号

    if(empty($_POST['sure'])){ //没有点击确定删除时，仅返回警告文本
        $count=$willCount[$delId]; //获得该课程号已选人数
        echo "该课程已选人数为 $count 人，删除课程将会影响已经选课学生的数据，确定删除吗？";
    }
    else{ //点击确认删除时，删除该课程
        /* 删除学生端已选信息 */
        $sql="delete from stucou where CouNo='$delId'";
        $result=mysqli_query($conn,$sql);
        if($result){ echo "学生对应选课已退出！<br>";}
        else{ echo "学生对应选课未退出！".mysqli_error($conn);}
        /* 删除课程 */
        $sql2="delete from course where CouNo='$delId'";
        $result2=mysqli_query($conn,$sql2);
        if($result2){ echo "课程已删除！<br>";}
        else{ echo "课程删除失败！".mysqli_error($conn);}
    }
    
?>