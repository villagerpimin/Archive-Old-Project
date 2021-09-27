<?php require("./WillCount.php"); ?> <!-- 更新选修数据 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生端</title>
    <link rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="./jquery-3.6.0.min.js"></script>
    <script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <script>
        $(function(){
            var stuNo='<?php echo $_GET['sid']; ?>'; //学号
            /* 通过读取删除键的data值判断应该删除哪个已选课程 */
            $("[name=delCou]").on('click',function(){
                var delId=$(this).attr("data"); //读取课程号,对应表stucou
                $("[name=sure]").on('click',function(){
                    $.post('./stu/delCou.php',{dcno:delId,sno:stuNo},function(result){
                        if(result=="success"){
                            $("#delsucc").removeClass("hide");
                            setTimeout(function(){
                                location.reload(); //一秒后刷新数据
                            },1000);
                        }
                        else{
                            $("#delerr").removeClass("hide");
                            console.log(result);
                        }
                    });
                })
            })

            /* 通过读取选课的多选框判断选中课程是否超出限制 */
            var addArr=new Array(); //已选课程
            $("[name='addCou']").on('click',function(){
                var addId=$(this).attr("data"); //读取选项值
                var selectCount=$('#showcou').attr("data-scount")==null?0:$('#showcou').attr("data-scount"); //获得已经选课的数量
                var range=5-selectCount; //可选数量
                if($(this).prop("checked")){ //选中状态时直接向数组添加已选课程id(CouNo)
                    addArr.push(addId);
                }
                else{ //取消选择时则删除
                    addArr.pop(); //删除末尾数据
                }
                if(addArr.length>range){
                    addArr.pop(); //将多出的数据删除
                    $(this).prop("checked",false); //将多出的选项取消选择
                    $("#countMd").addClass("show");
                }
                //console.log("limit:"+range);
            })
            //用于关闭警告框
            $("#cloc").on('click',function(){$("#countMd").removeClass("show")});
            /* 添加选课 */
            $("[name=sendAdd]").on('click',function(){
                //console.log(addArr);
                //console.log(stuNo)
                /* 将获取的选课数据发送到处理页 */
                $.post('./stu/addCou.php',{selectedCou:addArr,sid:stuNo},function(result){
                    if($.isNumeric(result)){ //成功时会返回数字
                        $("#addsucc").removeClass("hide");
                        setTimeout(function(){
                            location.reload();
                        },1000)
                    }
                    else{
                        $("#adderr").removeClass("hide");
                        $("#showerr").html(result);
                        console.log(result);
                    }
                })
            })

            /* 搜索课程 */
            $("#search").on('click',function(){
                var sval=$("#searchCou").val();
                $.post('./stu/searchCou.php',{sr:sval,sid:stuNo},function(result){
                    $("[name=showcou]").remove();
                    $("#aps").append(result);
                })
            })

        })
    </script>
</head>
<body>
    <!-- 页面导航 -->
    <div class="container">
        <div class="navbar navbar-default">
            <div class="navbar-header">
                <!-- 标题 -->
                <span class="navbar-brand">
                    学生选课系统
                </span>
                <button class="collapsed navbar-toggle" data-toggle="collapse"
                    data-target="#list">
                    <i class="icon-bar"></i>
                    <i class="icon-bar"></i>
                    <i class="icon-bar"></i>
                </button>
            </div>
            <!-- 列表项 -->
            <div id="list" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="../index.php">首页</a></li>
                    <li><a href="../t1/exam1.php">登录注册系统</a></li>
                    <li><a href="./exam2.php">切换账号</a></li>
                </ul>
            </div>
        </div>

        <!-- 欢迎语 -->
        <div class="jumbotron">

            <?php
                $sid=$_GET['sid']; //获得学生id
                include("./connect.php");
                //查询当前学生信息
                $stuInfo="select * from student where StuNo='$sid'";
                $InfoRes=mysqli_query($conn,$stuInfo);
                $InfoRow=mysqli_fetch_array($InfoRes); //获得学生信息
            ?>

            <h2>欢迎！<?php echo $InfoRow['StuName'] ?></h2>
        </div>

        <!-- 警告框，用于提示操作状态 -->
        <div class="alert alert-success hide" id="delsucc">
            删除成功!一秒后会刷新数据。<button class="close" data-dismiss="alert">&times;</button>
        </div>
        <div class="alert alert-danger hide" id="delerr">
            删除失败！<button class="close" data-dismiss="alert">&times;</button>
        </div>

        <div class="alert alert-success hide" id="addsucc">
            添加成功!一秒后会刷新数据。<button class="close" data-dismiss="alert">&times;</button>
        </div>
        <div class="alert alert-danger hide" id="adderr">
            添加失败！<button class="close" data-dismiss="alert">&times;</button>
        </div>


        <div class="row">
            <!-- 列表(学生信息展示) -->
            <div class="col-sm-3 col-xs-6">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success">
                        <h3>学生信息：</h3>
                    </li>
                    <li class="list-group-item">
                        学号：<?php echo $sid ?>
                    </li>
                    <li class="list-group-item">
                        <!-- 查询当前学生的班级信息 -->
                        <?php
                            $classInfo="select * from class where ClassNo='".$InfoRow['ClassNo']."'";
                            $classRes=mysqli_query($conn,$classInfo);
                            $classRow=mysqli_fetch_array($classRes);
                        ?>
                        所在班级：<?php echo $classRow['ClassName'] ?>
                    </li>
                    <li class="list-group-item">
                        <!-- 通过所在班级查询所属院系 -->
                        <?php
                            $departno=$classRow['DepartNo'];
                            $departInfo="select * from department where DepartNo='$departno'";
                            $departRes=mysqli_query($conn,$departInfo);
                            $departRow=mysqli_fetch_array($departRes);
                        ?>
                        院系：<?php echo $departRow['DepartName'] ?>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-sm-12">
                    <ul class="list-group">
                    <li class="list-group-item list-group-item-danger">
                        查询课程:
                    </li>
                    <li class="list-group-item" id="aps">
                        <div class="input-group">
                            <input type="text" name="searchCou" id="searchCou" 
                                class="form-control" placeholder="输入课程名">
                            <span class="input-group-btn">
                                <button id="search" class="btn btn-default">
                                <i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </li>
                    
                    <!-- 这里展示搜索数据 -->
                    
                </ul>
                    </div>
                </div>
            </div>

            <!-- 已选课信息展示 -->
            <div class="col-sm-9 col-xs-6">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info">
                        <h3>已选课程信息：</h3>
                    </li>
                        <!-- 通过学号查询学生选课信息 -->
                        <?php
                            $STCouInfo="select * from stucou where StuNo=$sid order by WillOrder"; /* 查询已选信息 */
                            $STCouRes=mysqli_query($conn,$STCouInfo);
                            /* 通过已选信息的课程号查询课程详细信息 */
                            while($STCouRow=mysqli_fetch_array($STCouRes)){
                                $CouInfo="select * from course where CouNo='".$STCouRow["CouNo"]."'";
                                $CouRes=mysqli_query($conn,$CouInfo);
                                $CouRow=mysqli_fetch_array($CouRes);
                                echo "<li class='list-group-item' id='showcou' data-scount='$STCouRes->num_rows'>
                                    课程名：".$CouRow['CouName'].
                                    "<br>课程类型：".$CouRow['Kind'].
                                    "<br>学时：".$CouRow['Credit'].
                                    "<br>任课教师：".$CouRow['Teacher'].
                                    "<br>课程时间：".$CouRow['SchoolTime'].
                                    "<br>报名状态：".$STCouRow['State'].
                                    "<a name='delCou' data=".$STCouRow['CouNo']." 
                                        class='badge' data-toggle='modal' href='#delMd'>删除</a>"
                                    ."</li>";
                            }
                        ?>
                        <!-- 点击删除后显示模态框 -->
                        <div class="modal fade" id="delMd">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">警告</h3>
                                    </div>
                                    <div class="modal-body">
                                        确定退出该课程码？
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary"
                                            data-dismiss="modal">手滑了</button>
                                        <button class="btn btn-primary" name="sure"
                                            data-dismiss="modal">
                                            确定退出</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </ul>
            </div>
        </div>

        <div class="row">
            <!-- 选课信息展示 -->
            <div class="col-sm-12 col-xs-12">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-warning">
                        <h3>可选课程：
                            <span class="badge btn btn-default" name="sendAdd">提交选课</span></h3>
                    </li>
                    <!-- 通过过滤已选课程信息展示 -->
                    <?php
                        $STCouInfo="select * from stucou where StuNo=$sid"; /* 查询已选信息 */
                        $STCouRes=mysqli_query($conn,$STCouInfo);
                        $AddCouInfo="select * from course where ";
                        while($STCouRow=mysqli_fetch_array($STCouRes)){
                            $AddCouInfo.="CouNo!=".$STCouRow['CouNo']." and ";
                        }
                        $AddCouInfo=substr($AddCouInfo,0,strlen($AddCouInfo)-5); //将后面多出来的 and 截取
                        //echo $AddCouInfo;
                        /* 使用已过滤的语句查询 */
                        $AddCouRes=mysqli_query($conn,$AddCouInfo);
                        while($AddCouRow=mysqli_fetch_array($AddCouRes)){
                            echo "<li class='list-group-item'>
                                课程名：".$AddCouRow['CouName'].
                                "<br>课程类型：".$AddCouRow['Kind'].
                                "<br>学时：".$AddCouRow['Credit'].
                                "<br>任课教师：".$AddCouRow['Teacher'].
                                "<br>课程时间：".$AddCouRow['SchoolTime'].
                                "<span class='badge'><input class='form-check' type='checkbox' 
                                    name='addCou' data=".$AddCouRow['CouNo'].">
                                    <span>报名</span></span>"
                                ."</li>";
                        }
                    ?>
                    <li class="list-group-item"><!-- 提交选课 -->
                        <button name="sendAdd" class="btn btn-default">提交选课</button>
                    </li>
                </ul>
            </div>

            <!-- 选课数量超出限制后显示模态框 -->
            <div class="modal" id="countMd">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">警告</h3>
                        </div>
                        <div class="modal-body">
                            选课数量过多！每个人最多只能选择5门(包括已选课程)
                        </div>
                        <div class="modal-footer">
                        <button class="btn btn-primary"
                            data-dismiss="modal" id="cloc">
                                好</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id="showerr"></div>
        
    </div>
</body>
</html>