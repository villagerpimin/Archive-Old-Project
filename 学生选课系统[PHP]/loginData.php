<?php
//页面对应exam1.php，用于用户登录注册操作
    if(!empty($_POST["username"])){
        $name=$_POST['username'];
        $pwd=$_POST['password'];
        /* 连接数据库 */
        include("./connect.php");
        /* 查询 */
        $stu="select * from student where StuNo='$name' and Pwd='$pwd'";
        $tea="select * from teacher where TeaNo='$name' and Pwd='$pwd'";
        /* 执行 */
        $result=mysqli_query($conn,$stu);
        $row=mysqli_fetch_array($result); //读取数据
        if(empty($row)){
            //进一步查询
            $result=mysqli_query($conn,$tea);
            $row=mysqli_fetch_array($result);
            if(empty($row)){
                echo "err";
            }
            else{ //如果教师表有数据
                echo "tea";
            }
        }
        else{ //如果学生表有数据
            echo "stu";
        }
    }
    else{
        echo "没传值";
        var_dump($_POST);
    }
?>