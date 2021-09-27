$(function(){

    //提交搜索
    $("#serachsub").click(function(){
        $(".navbar-form").submit()
    })

    var userid=$("#loging").data("userid"); //用户id
    console.log(userid!=null?"已登陆":"未登录");

    //退出登录
    $("#exituser").click(function(){
        document.cookie="id=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
        document.cookie="username=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
        document.cookie="password=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
        location.reload();
    })

    var snum=$("#gamenum").data("buynum"); //当前页数

        $("#gamenum").on('keyup',function(event){
            if(event.keyCode==13){
              alert(snum);
                snum=$("#gamenum").val();
                    $.post('./data/shop.php',{page:snum},function(res){
                        $("#hot_item").html(res);
            })
        }
    })

    /* 增加数量 */
    $("[name=jia]").on("click",function(){
        if($(this).data("num")>=99){
            alert('数量超过限制');
        }
        else{
            var gameid=$(this).data("gid"); //获得要修改的游戏id
            var oldnum=$("[name=gamenum"+gameid+"]").val();
            $.post("./data/shopCarControl.php",{uid:userid,gid:gameid,code:1},function(res){
                if(res=="ok"){
                    $("[name=gamenum"+gameid+"]").val(++oldnum); //将输入框的值替换
                    /* 将两个按钮的值替换 */
                    $(this).data("num",++oldnum);
                    $("[name=jian]").data("num",++oldnum);
                }
                else{
                    console.log(res)
                }
            })
        }
    });

    /* 减少数量 */
    $("[name=jian]").on("click",function(){
        if($(this).data("num")>1){ //数量大于1时执行减少操作
            var gameid=$(this).data("gid");
            var oldnum=$("[name=gamenum"+gameid+"]").val();
            $.post("./data/shopCarControl.php",{uid:userid,gid:gameid,code:2},function(res){
                if(res=="ok"){
                    $("[name=gamenum"+gameid+"]").val(--oldnum);
                    $(this).data("num",--oldnum);
                    $("[name=jia]").data("num",--oldnum);
                }
                else{
                    console.log(res);
                }
            })
        }
    })

    /* 修改数量 */
    $(".inps").on("keyup",function(e){
        if(e.keyCode==13){
            if($(this).val()>1 && $(this).val()<=99){ //数量大于1时且小于99时执行修改操作
                var gameid=$(this).data("gid");
                var oldnum=$(this).val();
                $.post("./data/shopCarControl.php",{uid:userid,gid:gameid,code:3,xg:oldnum},function(res){
                    if(res=="ok"){
                        $("[name=jian]").data("num",oldnum);
                        $("[name=jia]").data("num",oldnum);
                        console.log(res);
                    }
                    else{
                        console.log(res);
                    }
                })
            }
        }
    })

    /* 删除商品 */
    $("[name=del]").on("click",function(){
        if(confirm('确定删除该商品吗？')){
            var gameid=$(this).data("delid");
            $.post("./data/shopCarControl.php",{uid:userid,gid:gameid,code:4},function(res){
                if(res=="ok"){
                    location.reload();
                }
                else{
                    console.log(res);
                }
            })
        }
    })

    /* 商品总价 */
    var price=0; //右下方显示的总价格
    var jiesheng=0; //节省的价格
    var gameidArr=[]; //获得已选的游戏id

    //计算节省的钱和总价
    $("[name=checkgid]").on("click",function(){
        if($(this).prop("checked")){ //选中时将游戏id存入数组
            gameidArr.push($(this).val());
        }
        else{
            gameidArr.pop();
        }
        //console.log(gameidArr)
        //计算节省的钱
        $.post("./data/shopCarControl.php",{uid:userid,garr:gameidArr,code:5},function(res){
            if($.isNumeric(res)){ //判断返回的是否为数字
                $("#jiesheng").html("￥&nbsp;"+res);
            }
            else{
                console.log(res);
            }
        })
        //计算总价
        $.post("./data/shopCarControl.php",{uid:userid,garr:gameidArr,code:6},function(res){
            if($.isNumeric(res)){ //判断返回的是否为数字
                $(".jiner").html("￥&nbsp;"+res);
            }
            else{
                console.log(res);
            }
        })
    })

    //全选和取消全选
    $("#quan").on("click",function(){
        if($(this).prop("checked")){ //全选
            $("[name=checkgid]").each(function(){
                $(this).prop("checked",true);
                gameidArr.push($(this).val());
            })
            //console.log(gameidArr)
        }
        else{ //取消全选
            $("[name=checkgid]").each(function(){
                $(this).prop("checked",false);
                gameidArr.pop();
            })
            //console.log(gameidArr)
        }
        //计算节省的钱
        $.post("./data/shopCarControl.php",{uid:userid,garr:gameidArr,code:5},function(res){
            if($.isNumeric(res)){ //判断返回的是否为数字
                $("#jiesheng").html("￥&nbsp;"+res);
            }
            else{
                console.log(res);
            }
        })
        //计算总价
        $.post("./data/shopCarControl.php",{uid:userid,garr:gameidArr,code:6},function(res){
            if($.isNumeric(res)){ //判断返回的是否为数字
                $(".jiner").html("￥&nbsp;"+res);
            }
            else{
                console.log(res);
            }
        })
    })
})
