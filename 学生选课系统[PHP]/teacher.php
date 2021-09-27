<?php require("./WillCount.php"); ?> <!-- 更新选修数据 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>教师端</title>
    <link rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="./jquery-3.6.0.min.js"></script>
    <script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <script>
        $(function(){
            var teaNo=<?php echo $_GET['tid']; ?>; //获得当前教师号
            /* 搜索课程 */
            $("#search").on('click',function(){
                var sval=$("[name=searchCou]").val();
                $.post('./stu/searchCou.php',{sr:sval,tid:teaNo},function(result){
                    $("[name=showcou]").remove(); //如果有旧数据则会被删除
                    $("#aps").append(result);
                })
            })
            
            /* 添加课程 */
            $("#rein").on('click',function(){ //清除输入框数据
                $("#cno").val("");
                $("#cname").val("");
                $("#ccredit").val(""); //学时
                $("#ctea").val("");
                $("#ctime").val("");
                $("#climt").val(""); //限制人数
                //#ckind课程类型，#cdepart院系id
            })

            $("#sendin").on('click',function(){ //判断后向数据库添加信息
                var err=0;
                $("#insCou").find("input").each(function(){ //遍历输入框
                    if($(this).val()==""){ //如果有输入框则显示错误
                        err++; //有空项时错误数+1
                    }
                })
                //console.log(err)
                if(err===0){ //验证没有空项时
                    //cno 课程号,cname 课程名,credit 学时,ctea 任课教师
                    //ctime 上课时间,climt 限制人数,ckind 课程类型,cdepart 所属院系
                    var inpData={cno:$("#cno").val(),cname:$("#cname").val(),credit:$("#ccredit").val(),
                        ctea:$("#ctea").val(),ctime:$("#ctime").val(),climt:$("#climt").val(),
                        ckind:$("#ckind").val(),cdepart:$("#cdepart").val()}
                    $.post("./tea/insertCou.php",inpData,function(result){
                        //$("#showerr").html(result)
                        if(result=="success"){
                            $("#insucc").removeClass("hide") //显示成功信息
                            setTimeout(function(){
                                location.reload(); //自动刷新
                            },2000)
                        }
                        else{ //错误时将信息打印到控制台
                            $("#inserr").removeClass("hide"); //显示错误信息
                            console.log(result);
                        }
                    })
                }
                else{$("#inerr").removeClass("hide");} //显示输入错误信息
            })

            $("#cloinerr,#cloinserr").on('click',function(){
                $("#inerr,#inserr").addClass("hide"); //关闭错误提示
            })

            /* 修改课程 */
            //显示数据
            $("#showCou").on('click',"#upTran",function(e){ //使用on函数操作php动态添加的元素
                e.preventDefault();
                var postData=$(this).attr("data"); //获得要修改的课程号
                //console.log("点击了修改按钮，传递的值为："+postData)
                $.post("./tea/showUpList.php",{upId:postData},function(res){
                    $("#ups").html(res);
                })
                $(this).tab('show'); //调用bootstrap插件的选项卡方法
                $("[name=showc]").removeClass("active");
                $("[name=upc]").addClass("active");
            })
            //提交数据
            $("#upCou").on('mouseenter',function(){
                $("#reup").click(function(){ //重填
                    $("#upcno").val("");
                    $("#upcname").val("");
                    $("#upccredit").val(""); //学时
                    $("#upctea").val("");
                    $("#upctime").val("");
                    $("#upclimt").val(""); //限制人数
                });
                
                $("#sendup").click(function(){ //提交
                    var err=0;
                    $("#upCou").find("input").each(function(){ //遍历输入框
                        if($(this).val()==""){ //如果有输入框则显示错误
                            err++; //有空项时错误数+1
                        }
                    })
                    //console.log(err)
                    if(err===0){ //验证没有空项时
                        //upcno 课程号,upcname 课程名,upcredit 学时,upctea 任课教师
                        //upctime 上课时间,upclimt 限制人数,upckind 课程类型,upcdepart 所属院系
                        var upData={upcno:$("#upcno").val(),upcname:$("#upcname").val(),
                            upcredit:$("#upccredit").val(),upctea:$("#upctea").val(),
                            upctime:$("#upctime").val(),upclimt:$("#upclimt").val(),
                            upckind:$("#upckind").val(),upcdepart:$("#upcdepart").val()}
                        $.post("./tea/updateCou.php",upData,function(result){
                            //$("#showerr").html(result)
                            if(result=="success"){
                                $("#upsucc").removeClass("hide") //显示成功信息
                                setTimeout(function(){
                                    location.reload(); //自动刷新
                                },2000)
                            }
                            else{ //错误时将信息打印到控制台
                                $("#upserr").removeClass("hide"); //显示错误信息
                                console.log(result);
                            }
                        })
                    }
                    else{$("#inerr").removeClass("hide");} //显示输入错误信息
                });
                $("#clouperr,#cloupserr").on('click',function(){
                    $("#uperr,#upserr").addClass("hide"); //关闭错误提示
                })
            })

            /* 删除数据 */
            $("#delSearch").on('click',function(){ //搜索课程
                var sval=$("[name=delSearchCou]").val();
                //console.log(sval)
                $.post('./tea/showDelList.php',{dsr:sval},function(result){
                    $("[name=showdelcou]").remove(); //如果有旧数据则会被删除
                    $("#dels").append(result);
                })
            })
            $("#delCou").on('click',"#delTran",function(){ //向处理页传值
                //console.log($(this).attr("data"))
                var delId=$(this).attr("data"); //获取要删除的课程号
                $("#delModal").removeClass("hide");
                $.post('./tea/deleteCou.php',{delid:delId},function(res){
                    $("#delModalMsg").html(res); //设置提示的数据
                    $("#delModal").addClass("show");
                })

                /* 点击确认删除时 */
                $("#delModalSend").click(function(){
                    $.post('./tea/deleteCou.php',{delid:delId,sure:"1"},function(res){
                        $("#delModalMsg").html(res); //设置提示的数据
                    })
                })
            })
            $("#delModalClo").on('click',function(){
                $("#delModal").removeClass("show");
                $("#delModal").addClass("hide"); //点击关闭按钮
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
                    教师管理系统
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
                $tid=$_GET['tid']; //获得老师id
                include("./connect.php");
                //查询当前老师信息
                $teaInfo="select * from teacher where TeaNo='$tid'";
                $InfoRes=mysqli_query($conn,$teaInfo);
                $InfoRow=mysqli_fetch_array($InfoRes); //获得老师信息
            ?>

            <h2>欢迎！<?php echo $InfoRow['TeaName'] ?> 老师</h2>
        </div>


        <div class="row">
            <!-- 列表(教师信息展示) -->
            <div class="col-sm-4 col-xs-12">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success">
                        <h3>教师信息：</h3>
                    </li>
                    <li class="list-group-item">
                        教师号：<?php echo $tid ?>
                    </li>
                    <li class="list-group-item">
                        <!-- 查询教师所属院系 -->
                        <?php
                            $departno=$InfoRow['DepartNo'];
                            $departInfo="select * from department where DepartNo='$departno'";
                            $departRes=mysqli_query($conn,$departInfo);
                            $departRow=mysqli_fetch_array($departRes);
                        ?>
                        所属院系：<?php echo $departRow['DepartName'] ?>
                    </li>
                </ul>
            </div>

            <!-- 查询课程 -->
            <div class="col-sm-8 col-xs-12">
        <!-- 教师操作 -->
        <div class="alert alert-info" id="teaConfig">
            <h3>教师操作工具</h3>
        </div>
        <!-- 选项卡 -->
        <ul class="nav nav-tabs">
            <li class="active" name="showc"><a href="#showCou" data-toggle="tab">课程浏览</a></li>
            <li name="adc"><a href="#insCou" data-toggle="tab">添加课程</a></li>
            <li name="upc"><a href="#upCou" data-toggle="tab">修改课程</a></li>
            <li name="delc"><a href="#delCou" data-toggle="tab">删除课程</a></li>
        </ul>

        <div class="tab-content">
            <!-- 课程浏览 -->
            <div id="showCou" class="tab-pane active">
                <ul class="list-group">
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
                    <!-- 课程信息展示 -->
                    <?php
                        $CouInfo="select * from course order by CouNo desc";
                        $CouRes=mysqli_query($conn,$CouInfo);
                        while($CouRow=mysqli_fetch_array($CouRes)){
                            echo "<li class='list-group-item' name='showcou'>
                                课程号：".$CouRow['CouNo'].
                                "<br>课程名：".$CouRow['CouName'].
                                "<br>课程类型：".$CouRow['Kind'].
                                "<br>学时：".$CouRow['Credit'].
                                "<br>任课教师：".$CouRow['Teacher'].
                                "<br>课程时间：".$CouRow['SchoolTime'].
                                "<br>选课人数：".$CouRow['WillNum'].
                                "<br><a href='#upCou' data='".$CouRow['CouNo']."' 
                                    class='badge' style='margin-top:-20px;'
                                    id='upTran'>修改</a>".
                                "</li>";
                        }
                    ?>
                </ul>
            </div>

            <!-- 添加课程 -->
            <div id="insCou" class="tab-pane">
                <br>
                <!-- 表单内容 -->
                <div class="col-sm-8 list-group">
                    <div class="list-group-item">
                        <label for="cno" class="control-label">课程号：</label>
                        <input type="text" name="cno" id="cno" class="form-control">
                        <br>
                        <label for="cname">课程名</label>
                        <input type="text" name="cname" id="cname" class="form-control">
                        <br>
                        <label for="ckind">课程类型</label>
                        <select name="ckind" id="ckind" class="form-control">
                            <!-- 从数据库读取类型 -->
                            <?php
                                $getKind="select distinct kind from course"; //不重复查询
                                $reKind=mysqli_query($conn,$getKind);
                                while($kindRow=mysqli_fetch_array($reKind)){
                                    echo "<option value='$kindRow[0]'>$kindRow[0]</option>";
                                }
                            ?>
                        </select>
                        <br>
                        <label for="ccredit">课程学时</label>
                        <input type="number" name="ccredit" id="ccredit" class="form-control">
                        <br>
                        <label for="ctea">任课教师</label>
                        <input type="text" name="ctea" id="ctea" class="form-control">
                        <br>
                        <label for="cdepart">任课教师所属院系</label>
                        <select name="cdepart" id="cdepart" class="form-control">
                                <!-- 从数据库读取院系信息 -->
                                <?php
                                    $getDepart="select * from department";
                                    $reDepart=mysqli_query($conn,$getDepart);
                                    while($departRow=mysqli_fetch_array($reDepart)){
                                        echo "<option value='$departRow[0]'>$departRow[1]</option>";
                                    }
                                ?>
                        </select>
                        <br>
                        <label for="ctime">任课时间</label>
                        <input type="text" name="ctime" id="ctime" class="form-control">
                        <br>
                        <label for="climt">限制选修人数</label>
                        <input type="number" name="climt" id="climt" class="form-control">
                        <br>
                    </div>
                                            
                </div>
                <!-- 按钮 -->
                <div class="col-sm-4 col-xs-2">
                    <button class="btn btn-default" id="rein">重填</button>
                    <button class="btn btn-primary" id="sendin">提交</button>
                    <br><br>
                    <div class="help-block">
                        注意：表格中所有数据都是必填信息，确认无误后提交
                    </div>
                    
                    <br><br>
                    <!-- 用于显示js返回数据 -->
                    <div class="alert alert-danger hide" id="inerr">
                        <button class="close" id="cloinerr">&times;</button>
                        缺少某些必要信息或输入了错误的数据，请检查！
                    </div>
                    <div class="alert alert-success hide" id="insucc">
                        添加课程成功！两秒后刷新数据
                    </div>
                    <div class="alert alert-danger hide" id="inserr">
                        <button class="close" id="cloinserr">&times;</button>
                        添加课程失败！请查看控制台
                    </div>
                </div>
            </div>

            <!-- 修改课程 -->
            <div id="upCou" class="tab-pane">
                <br>
                <!-- 表单内容 -->
                <div class="col-sm-8 list-group" id="ups">
                请先在“课程浏览”中选择要修改的课程！
                </div>
                <!-- 按钮 -->
                <div class="col-sm-4 col-xs-2">
                    <button class="btn btn-default" id="reup">重填</button>
                    <button class="btn btn-primary" id="sendup">提交</button>
                    <br><br>
                    <div class="help-block">
                        注意：表格中所有数据都是必填信息，确认无误后提交
                    </div>
                    
                    <br><br>
                    <!-- 用于显示js返回数据 -->
                    <div class="alert alert-danger hide" id="uperr">
                        <button class="close" id="clouperr">&times;</button>
                        缺少某些必要信息或输入了错误的数据，请检查！
                    </div>
                    <div class="alert alert-success hide" id="upsucc">
                        修改课程成功！两秒后刷新数据
                    </div>
                    <div class="alert alert-danger hide" id="upserr">
                        <button class="close" id="cloupserr">&times;</button>
                        修改课程失败！请查看控制台
                    </div>
                </div>
            </div>

            <!-- 删除课程 -->
            <div id="delCou" class="tab-pane">
                <ul class="list-group">
                    <li class="list-group-item" id="dels">
                        <div class="input-group">
                            <input type="text" name="delSearchCou" 
                                class="form-control" placeholder="输入课程名">
                            <span class="input-group-btn">
                                <button id="delSearch" class="btn btn-default">
                                <i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </li>
                    <!-- 课程信息展示 -->
                    <?php
                        $CouInfo="select * from course";
                        $CouRes=mysqli_query($conn,$CouInfo);
                        while($CouRow=mysqli_fetch_array($CouRes)){
                            echo "<li class='list-group-item' name='showdelcou'>
                                课程号：".$CouRow['CouNo'].
                                "<br>课程名：".$CouRow['CouName'].
                                "<br>课程类型：".$CouRow['Kind'].
                                "<br>学时：".$CouRow['Credit'].
                                "<br>任课教师：".$CouRow['Teacher'].
                                "<br>课程时间：".$CouRow['SchoolTime'].
                                "<br><a data='".$CouRow['CouNo']."' 
                                    class='badge' style='margin-top:-20px;'
                                    id='delTran'>删除</a>".
                                "</li>";
                        }
                    ?>
                </ul>
            </div>
            <!-- 点击删除后显示模态框 -->
            <div class="modal" id="delModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">警告</h3>
                        </div>
                        <div class="modal-body" id="delModalMsg">
                            <!-- 这里的警告内容由js输出 -->警告
                        </div>
                        <div class="modal-footer">
                            <button id="delModalClo" class="btn btn-primary">关闭</button>
                            <button id="delModalSend" class="btn btn-primary">确定删除</button>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- tab-conent -->

            </div><!-- col-* -->
        </div><!-- row -->

        <!-- 调试用 -->
        <div id="showerr"></div>
    </div>
</body>
</html>