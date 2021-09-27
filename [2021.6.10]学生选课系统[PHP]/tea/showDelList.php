<?php
    /* 用于展示搜索的课程 */
    $search=$_POST['dsr']; //获得搜索内容
    include("../connect.php");
    $dCouInfo="select * from course where CouName like '%$search%'"; /* 通过课程名模糊查询 */
    $dCouRes=mysqli_query($conn,$dCouInfo);
    if($dCouRes->num_rows!=0){ //有值则继续
        /* 通过已选信息的课程号查询课程详细信息 */
        while($dCouRow=mysqli_fetch_array($dCouRes)){
            echo "
                <li class='list-group-item' name='showdelcou'>
                    课程名：".$dCouRow['CouName'].
                    "<br>课程类型：".$dCouRow['Kind'].
                    "<br>学时：".$dCouRow['Credit'].
                    "<br>任课教师：".$dCouRow['Teacher'].
                    "<br>课程时间：".$dCouRow['SchoolTime'].
                    "<br><a data='".$dCouRow['CouNo']."' 
                        class='badge' style='margin-top:-20px;'
                        id='delTran'>删除</a>".
                    "</li>";
        }
    }else{ //没值提示
        echo <<<html
            <li class='list-group-item' name='showdelcou'>
                没有该课程！
            </li>
        html;
    }
?>