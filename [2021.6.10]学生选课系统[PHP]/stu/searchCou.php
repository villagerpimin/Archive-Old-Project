<?php
/* 用于查询课程 */

    //获得学号或教师号
    if(empty($_POST['sid'])){ //如果没有学号发送，则代表搜索端为教师端
        $tid=$_POST['tid']; //获得教师号
    }
    else{
        $sid=$_POST['sid']; //获得学号
    }

    $search=$_POST['sr']; //获得搜索内容
    include("../connect.php");
    $CouInfo="select * from course where CouName like '%$search%'"; /* 通过课程名模糊查询 */
    $CouRes=mysqli_query($conn,$CouInfo);

    if(!empty($tid)){ //教师端查询
        if($CouRes->num_rows!=0){ //有值则继续
            /* 通过已选信息的课程号查询课程详细信息 */
            while($CouRow=mysqli_fetch_array($CouRes)){
                echo "
                    <li class='list-group-item' name='showcou'>
                        课程名：".$CouRow['CouName'].
                        "<br>课程类型：".$CouRow['Kind'].
                        "<br>学时：".$CouRow['Credit'].
                        "<br>任课教师：".$CouRow['Teacher'].
                        "<br>课程时间：".$CouRow['SchoolTime'].
                        "<br><a href='#upCou' data='".$CouRow['CouNo']."' 
                            class='badge' style='margin-top:-20px;'
                            id='upTran'>修改</a>".
                        "</li>";
            }
        }else{ //没值提示
            echo <<<html
                <li class='list-group-item' name='showcou'>
                    没有该课程！
                </li>
                html;
        }

    }else{ //学生端查询
        if($CouRes->num_rows!=0){ //有值则继续
            /* 通过已选信息的课程号查询课程详细信息 */
            while($CouRow=mysqli_fetch_array($CouRes)){
                $STCouInfo="select * from stucou where CouNo='".$CouRow["CouNo"]."' and StuNo=$sid";
                $STCouRes=mysqli_query($conn,$STCouInfo);
                $STCouRow=mysqli_fetch_array($STCouRes);
                echo "
                    <li class='list-group-item' name='showcou'>
                        课程名：".$CouRow['CouName'].
                        "<br>课程类型：".$CouRow['Kind'].
                        "<br>学时：".$CouRow['Credit'].
                        "<br>任课教师：".$CouRow['Teacher'].
                        "<br>课程时间：".$CouRow['SchoolTime'].
                        "<br>报名状态：".(empty($STCouRow['State'])?"未报名":"已报名").
                    "</li>";
            }
        }else{ //没值提示
            echo "没有该课程！";
        }
    }
?>