$(function(){
    let nowpage = location.pathname
    console.log(nowpage)
    /* tag.php */
    if(nowpage=="/uni/backstage/tag.php"){
        //console.log("当前位于标签管理页")
        var timeout
        $("[name=tags]").on("mousedown",function(){
            var that = this
            timeout=setTimeout(function(){
                var dataval = $(that).data("val")
                if(dataval!="create"){  //将标签内容填入输入框
                    $("#edit_tag").attr("value",$(that).data("val"))
                    $("#edit_tag").data("tid",$(that).data("tid"))
                }else{
                    $("#edit_tag").attr("value","")
                    $("#edit_tag").data("tid","")
                }
                /* 如果是点击特殊标签，禁用删除按钮 */
                if(dataval=="create" || dataval=="最新" || dataval=="热门"){
                    $("#del_tag").attr("disabled",true)
                }else{$("#del_tag").attr("disabled",false)}
                $("#showtag").modal("show")
            },100)
        })
        $("[name=tags]").on("mouseup",function(){clearTimeout(timeout)})
        $("#del_tag").on("click",function(){
            /* 删除标签 */
            if(confirm("确定删除该标签吗？")){
                $.post(
                    "./data/tagChange.php",{
                        "type":"del",
                        "tag":$("#edit_tag").val(),
                        "tid":$("#edit_tag").data("tid")
                    },function(res){
                        if(res){
                            alert("删除成功")
                            setTimeout(function(){
                                location.reload()
                            },500)
                        }
                    }
                )
            }
        })
        $("#save_tagchange").on("click",function(){
            /* 保存标签 */
            var tid = $("#edit_tag").data("tid")
            var type = tid==""?"create":"update"
            var tag = $("#edit_tag").val()
            $.post(
                "./data/tagChange.php",{
                    "tid":tid,
                    "type":type,
                    "tag":tag
                },function(res){
                    if(res){
                        alert("更新成功")
                        setTimeout(function(){
                            location.reload()
                        },500)
                    }
                }
            )
        })
    }
    /* banner_manager.php */
    if(nowpage=="/uni/backstage/banner_manager.php"){
        //console.log("当前位于轮播图管理页")
        var bid=null
        $("[name=banner_item]").on("click",function(){
            var type = $(this).data("type")
            if(type=="add"){
                /* 新建轮播图 */
                $("#edit_title").val("")
                $("#bannerpic_text").css("display","block")
                $("#del_banner").attr("disabled",true)
                $("[name=old]").attr("disabled",true)
                $("#bannerpic_preview").css("display","none")
                $("#nid").val("")
            }else{
                /* 修改轮播图 */
                $("#bannerpic_text").css("display","none")
                $("#del_banner").attr("disabled",false)
                $("[name=old]").attr("disabled",false)
                $("#bannerpic_preview").css("display","block")
                bid=$(this).data("bid")
                var that = this
                $.post(
                    "./data/getBannerInfo.php",
                    {
                        "bid":bid,
                    },function(res){
                        res=JSON.parse(res)  //将返回的json转换
                        $("#edit_title").val(res.title)
                        $("#bannerpic_preview").attr("src",res.img)
                        $("[name=old]").data("nid",res.nid)
                        $("#nid").val(res.nid)
                    }
                )
            }
            $("#showbanner").modal("show")
            $("#save_bannerchange").data("type",type)
        })/* 点击时的展示 */
        $("[name=old]").on("click",function(){
            var nid=$(this).data("nid")
            location.href="./module/edit_news.php?type=update&id="+nid
        })
        $("[name=new]").on("click",function(){
            location.href="./module/edit_news.php?type=create"
        })/* 点击跳转时 */
        $("#send_bannerpic").on("click",function(){
            var form = new FormData($("#bannerpic_upload")[0])
            $.ajax({
                type: 'POST',
                url: "./data/uploadBannerPic.php",
                data: form,
                // 告诉jQuery不要去处理发送的数据
                processData : false,
                // 告诉jQuery不要去设置Content-Type请求头
                contentType : false,
                dataType:"json",
                success(res){
                    if(res.status){
                        $("#bannerpic_text").css("display","none")
                        $("#bannerpic_preview").attr("src",res.path)
                        $("#bannerpic_preview").css("display","block")
                        $("#bannerpic_preview").data("filename",res.filename)
                    }
                    console.log(res)
                }
            })
        })/* 上传图片 */
        $("#save_bannerchange").on("click",function(){
            var title=$("#edit_title").val()
            var img=$("#bannerpic_preview").data("filename")
            var nid=$("#nid").val()
            var type=$(this).data("type")
            $.post(
                "./data/updateAndCreateBanner.php",
                {
                    "title":title,
                    "img":img,
                    "nid":nid,
                    "type":type,
                    "bid":bid!=null?bid:0
                },function(res){
                    if(res){
                        alert("操作成功")
                        setTimeout(function(){
                            location.reload()
                        },1500)
                    }
                    console.log(res)
                }
            )
        })/* 保存更改 */
        $("#del_banner").on("click",function(){
            if(confirm("确定删除吗？")){
                $.post(
                    "./data/removeBanner.php",
                    {"bid":bid},function(res){
                        if(res){
                            alert("删除成功")
                            setTimeout(function(){
                                location.reload()
                            },1500)
                        }
                    }
                )
            }else{console.log("取消")}
        })/* 删除轮播图 */
        $("#save_current").on("click",function(){
            var nowinp=$("#nid").val()
            $.post(
                "./data/saveCurrentBannerId.php",
                {"nowid":nowinp},function(res){
                    if(res){
                        alert("保存成功")
                        setTimeout(() => {
                            location.reload()
                        }, 1000);
                    }
                }
            )
            console.log("保存当前id新闻为轮播图")
        })
    }
})