<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生选课系统</title>
    <link rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="./jquery-3.6.0.min.js"></script>
    <script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <script>
        $(function(){
            /* 验证码被点击时 */
            $("#codePic").on('click',function(){
                /* 增加随机数不会死链 */
                $(this).attr("src","code_num.php?"+Math.random()*1000);
            })

            /* 提交 */
            $("[name=send]").on('click',function(){
                //判断用户名是否合理
                var name=$("#name").val();
                var zz=/^[0-9]*$/g; //用于判断是否为数字
                if(name!=null && zz.test(name)){ //zz.test传入的如果不是数字会返回false
                    var c=$("#code").val();
                    $.post("./checkCode.php",{pcode:c},function(msg){
                        if(msg==="true"){ //验证码正确时
                            var formData=new FormData($("#loginform")[0]);
                            $.ajax({
                                url:"./loginData.php",
                                type:"post",
                                data:formData,
                                processData:false, //不处理数据，直接提交表单
                                contentType:false, //不修改请求头
                                dataType:"text",
                                success(result){
                                    if(result==="stu"){ //代表没有该数据
                                        $("#succ").removeClass("hide");
                                        setTimeout(function(){
                                            location.href="./student.php?sid="+$("#name").val();
                                        },3000); //3秒后刷新
                                    }
                                    else if(result==="tea"){
                                        $("#succ").removeClass("hide");
                                        setTimeout(function(){
                                            location.href="./teacher.php?tid="+$("#name").val();
                                        },3000); //3秒后刷新
                                    }
                                    else{
                                        $("#err").removeClass("hide"); //将错误警告显示
                                        //$("#showdata").html(result)
                                    }
                                },
                                error(xhr){
                                    alert("登录失败")
                                    console.log(xhr)
                                }
                            })
                        }
                        else{ //验证码错误时
                            $("#errCode").removeClass("hide");
                            console.log(msg)
                        }
                    })
                }
                else{
                    $("#err").removeClass("hide"); //显示错误提示
                }
            })
        })
    </script>
</head>
<body>
<div class="container">
    <!-- 页头 -->
    <div class="row">
        <div class="col-sm-6">
            <div class="page-header">
                <h1>选课系统
                    <small>1930634 朱腾飞</small></h1>
            </div>
        </div>
    </div>
    <!-- 警告框，仅在表单验证有错误时显示 -->
        <div id="err" class="alert alert-danger hide fade in" title="有错误！">
            <button class="close" data-dismiss="alert">&times;</button>
            <p>用户名或密码不正确，请检查！</p>
        </div>
        <div id="errCode" class="alert alert-danger hide fade in" title="有错误！">
            <button class="close" data-dismiss="alert">&times;</button>
            <p>验证码不正确，请检查！</p>
        </div>
    <!-- 警告框，用于提示登录成功 -->
        <div id="succ" class="alert alert-success hide fade in" title="成功！">
            <button class="close" data-dismiss="alert">&times;</button>
            <p>登录成功！即将进入···</p>
        </div>
    <!-- 表单 -->
        <form action="<?php echo htmlspecialchars("loginData.php"); ?>" method="post"
            style="width: 35%;margin:auto;" id="loginform">

            <label for="name" class="form-label">用户名：</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-user"></i>
                </span>
                <input type="text" name="username" id="name" class="form-control" required>
            </div>
<br>
            <label for="pwd" class="form-label">密码：</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-lock"></i>
                </span>
                <input type="password" name="password" id="pwd" class="form-control" required>
            </div>
<br>
            <!-- 验证码 -->
            <label for="code">验证码：</label>
            <div class="input-group">
                <input type="text" id="code" class="form-control">
                <span class="input-group-addon">
                    <img src="./code_num.php" title="看不清？换一张" id="codePic">
                </span>
            </div>
<br><br>
            <input type="button" name="send" class="btn btn-primary" 
                value="登录">
        </form>
    </div>
    
    <div id="showdata"></div>
</body>
</html>