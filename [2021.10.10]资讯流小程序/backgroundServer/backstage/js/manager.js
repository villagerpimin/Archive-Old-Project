$(function(){
    let nowpage = location.pathname
    console.log(nowpage)
    /* manager.php */
    $("#func li").on("click",function(){
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("active").siblings().removeClass("active");  //siblings为其他同级样式
    })
    

    /* news.php */
    if(nowpage=="/uni/backstage/news.php"){
        //console.log("当前位于新闻管理页")
        $("[name=del_news]").on("click",function(e){
            e.preventDefault()  //取消默认事件
            var that=$(this)
            if(confirm("确定删除?")){
                $.post(
                    "./data/removeNews.php",
                    {id:$(this).val()},
                    function(res){
                        if(res==1){
                            /* 删除成功的同时将页面元素删除 */
                            that.parent().parent().remove()
                        }
                        else{
                            console.log(res)
                        }
                    }
                )
            }
        })
    }


    /* edit_news.php */
    if(nowpage=="/uni/backstage/module/edit_news.php"){
        //console.log("当前位于新闻编辑页")
        let picname=null;
        $("#send_headpic").on("click",function(){
            var form = new FormData($("#headpic_upload")[0])
            $.ajax({
                type: 'POST',
                url: "../data/uploadHeadPic.php",
                data: form,
                // 告诉jQuery不要去处理发送的数据
                processData : false,
                // 告诉jQuery不要去设置Content-Type请求头
                contentType : false,
                dataType:"json",
                success(res){
                    if(res.status){
                        $("#headpic_text").css("display","none")
                        $("#headpic_preview").attr("src",res.path)
                        picname=res.filename
                    }
                    console.log(res)
            }
            });
        })
        $("#reset").on("click",function(){
            /* 点击重置按钮时 */
            $("#headpic_text").css("display","block")
            $("#headpic_preview").attr("src","")
            $("#news_title").val("")
            $("#news_content").val("")
        })
        $("#send").on("click",function(){
            /* 点击提交按钮时 */
            var img=picname
            var title=$("#news_title").val()
            var content=$("#news_content").val()
            var tag=$("#tag").val()==""?null:$("#tag").val()
            $.post("../data/uploadNews.php",
                {
                    "img":img,
                    "title":title,
                    "content":content,
                    "tag":tag
                },function(res){
                    if(res==1){
                        alert("添加成功！")
                    }
                    console.log(res)
                }
            )
        })
        $("#update").on("click",function(){
            /* 点击了更新按钮时 */
            var nid=$("#update").data("id")  //新闻id
            var title=$("#news_title").val()
            var content=$("#news_content").val()
            var tag=$("#tag").val()==""?null:$("#tag").val()
            //如果有上传则使用返回的文件名
            var img=picname!=null ? picname:$("#headpic_preview").attr("src").substr(28)
            //img+="."+$("#headpic_preview").attr("src").split(".")[1]
            $.post("../data/updateNews.php",
                {
                    "img":img,
                    "title":title,
                    "content":content,
                    "tag":tag,
                    "nid":nid
                },function(res){
                    if(res==1){
                        alert("更新成功")
                    }
                    console.log(res)
                }
            )
        })
        /* 审核 */
        $("#news_fail").on("click",function(){
            /* 不通过时 */
            nid = $(this).data("id")
            $.post(
                "../data/auditConfig.php",
                {
                    "nid":nid,
                    "audit":"fail"
                },function(res){
                    if(res){
                        alert("操作成功")
                    }else{
                        alert("操作失败")
                    }
                    console.log(res)
                }
            )
        })
        $("#news_pass").on("click",function(){
            /* 通过时 */
            nid = $(this).data("id")
            $.post(
                "../data/auditConfig.php",
                {
                    "nid":nid,
                    "audit":"pass"
                },function(res){
                    if(res){
                        alert("操作成功")
                    }else{
                        alert("操作失败")
                    }
                    console.log(res)
                }
            )
        })
    }

    /* user.php */
    if(nowpage=="/uni/backstage/user.php"){
        //console.log("当前位于用户管理页")
        let user_imgpath;
        $("#saveChange").on("click",function(){
            /* 提交更改 */
            var type = $(this).data("type")  //new新建，change修改
            var img=type=="new"?user_imgpath:$("#userpic_preview").attr("src").substr(1)  //将路径的两点去掉
            var nickname = $("#username").val()
            var sex = $("#sex").val()
            var pwd = $("#pwd").val()
            var mail = $("#mail").val()
            var uid = $(this).data("id")
            $.post(
                "./data/updateAndCreateUser.php",
                {
                    "img":img,"type":type,"nickname":nickname,
                    "sex":sex,"pwd":pwd,"mail":mail,"uid":uid
                },function(res){
                    if(res==1){
                        $('#myModal').modal('hide')  //成功操作时将模态框关闭
                        $("#msg").modal("show")  //显示操作成功提示
                        setTimeout(function(){
                            location.reload()
                        },2000)
                    }
                    console.log(res)
                }
            )
        })
        $("#send_userpic").on("click",function(){
            //用户上传头像时
            var form = new FormData($("#userpic_upload")[0])
            $.ajax({
                type: 'POST',
                url: "./data/uploadUserPic.php",
                data: form,
                // 告诉jQuery不要去处理发送的数据
                processData : false,
                // 告诉jQuery不要去设置Content-Type请求头
                contentType : false,
                dataType:"json",
                success(res){
                    if(res.status){
                        $("#userpic_text").css("display","none")
                        $("#userpic_preview").attr("src",res.path)
                        picname=res.filename
                        user_imgpath=res.img
                    }
                    console.log(res)
                }
            })
        })
        $("[name=del_user]").on("click",function(e){
            e.preventDefault()
            var that=$(this)
            if(confirm("确定删除?")){
                $.post(
                    "./data/removeUser.php",
                    {id:$(this).val()},
                    function(res){
                        if(res==1){
                            /* 删除成功的同时将页面元素删除 */
                            that.parent().parent().remove()
                        }
                        else{
                            console.log(res)
                        }
                    }
                )
            }
        })
        $("[name=userinfo]").on("click",function(){
            var id = $(this).data("val")
            if(id==="create"){
                /* 如果是新建用户操作 */
                $("#userpic_text").css("display","block")
                $("#userpic_preview").attr("src","")
                $("#username").val("")
                $("#pwd").val("")
                $("[name=nan]").attr("selected",true)
                $("[name=nv]").attr("selected",false)
                $("#mail").val("")
                $("#saveChange").data("type","new")  //new代表提交时使用新建操作
            }
            else{
                /* 修改已有用户 */
                $("#saveChange").data("type","change")  //change代表提交时使用更新操作
                $.ajax({
                    type: 'POST',
                    url: "./data/getUserInfo.php",
                    data: {"id":id},
                    dataType:"json",
                    success(res){
                        /* 将返回的数据设置 */
                        $("#userpic_text").css("display","none")
                        $("#userpic_preview").attr("src",res["avatar"])
                        $("#username").val(res["name"])
                        $("#pwd").val(res["pwd"])
                        if(res["gender"]=="男"){
                            $("[name=nan]").attr("selected",true)
                            $("[name=nv]").attr("selected",false)
                        }else{
                            $("[name=nan]").attr("selected",false)
                            $("[name=nv]").attr("selected",true)
                        }
                        $("#mail").val(res["mail"])
                        $("#saveChange").data("id",res["id"])
                        //console.log(res)
                }
                })
            }
        })
    }
})