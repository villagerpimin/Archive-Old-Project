/* 用于处理验证的显示 */
$(function(){
    /* 验证码被点击时 */
    $("#codePic").on('click',function(){
        /* 增加随机数不会死链 */
        $(this).attr("src","js/code_num.php?"+Math.random()*1000);
    })

    /* 点击提交按钮时 */
    $("[name=send]").on('click',function(){
        login()
    })

    /* 验证码回车时 */
    $("#code").on('keyup',function(e){
        if(e.keyCode==13){
            login()
        }
    })

    function login(){
        //判断用户名是否合理
        var name=$("#name").val();
        var pwd=$("#pwd").val();
        if(name!=null && pwd!=null){
            var c=$("#code").val();
            $.post("./js/checkCode.php",{code:c},function(msg){
                if(msg){ //验证码正确时
                    var formData=new FormData($("#loginForm")[0]);
                    $.ajax({
                        url:"./data/loginData.php",
                        type:"post",
                        data:formData,
                        processData:false, //不处理数据，直接提交表单
                        contentType:false, //不修改请求头
                        dataType:"text",
                        success(result){
                            if(result=="ok"){
                                location.href="./manager.php"
                            }
                            else{
                                alert("登录失败！")
                                console.log(result)
                            }
                        },
                        error(err){
                            alert("登录失败")
                            console.log(err)
                        }
                    })
                }
                else{ //验证码错误时
                    alert("验证码错误")
                    $("#codePic").attr("src","js/code_num.php?"+Math.random()*1000);
                    console.log(msg)
                }
            })
        }
        else{
            alert("账号和密码不能为空！")
        }
    }
})